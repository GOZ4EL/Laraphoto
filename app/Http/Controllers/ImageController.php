<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view("image.create");
    }

    public function save(Request $request) {
        $validate = $this->validate($request, [
            "description" => "required",
            "image_path" => "required|image"
        ]);

        $image_path = $request->file("image_path");
        $description = $request->input("description");

        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        if($image_path) {
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk("images")->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route("home")->with([
            "message" => "La foto ha sido subida correctamente"
        ]);
    }

    public function get(String $filename) {
        $file = Storage::disk("images")->get($filename);
        return new Response($file, 200);
    }

    public function detail($id) {
        $image = Image::find($id);

        return view("image.detail", [
            "image" => $image
        ]);
    }

    public function delete($id) {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where("image_id", $id)->get();
        $likes = Like::where("image_id", $id)->get();

        if(!$user || !$image || $image->user_id != $user->id)
            return redirect()->route("home");

        if($comments && count($comments) >= 1)
            foreach($comments as $comment)
                $comment->delete();

        if($likes && count($likes) >= 1)
            foreach($likes as $like)
                $like->delete();

        Storage::disk("images")->delete($image->image_path);

        $image->delete();

        return redirect()->route("user.profile", ["id" => $user->id])
                         ->with(["message" => "La imagen se ha eliminado correctamente"]);
    }

    public function edit($id) {
        $user = \Auth::user();
        $image = Image::find($id);

        if(!$user || !$image || $image->user_id != $user->id)
            return redirect()->route("home");

        return view("image.edit", ["image" => $image]);
    }

    public function update(Request $request) {
        $validate = $this->validate($request, ["description" => "required"]);

        $image_id = $request->input("image_id");
        $description = $request->input("description");

        $image = Image::find($image_id);
        $image->description = $description;

        $image->update();

        return redirect()->route("image.detail", ["id" => $image_id])
                         ->with(["message" => "Imagen actualizada correctamente"]);
    }
}
