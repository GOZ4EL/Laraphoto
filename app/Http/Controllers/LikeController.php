<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller {
    public function __construct() {
        $this->middleware("auth");
    }

    public function like($image_id) {
        $user = \Auth::user();

        $like_rows = Like::where("user_id", $user->id)->where("image_id", $image_id)->count();

        if($like_rows == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            $like->save();
        }
    }

    public function dislike($image_id) {
        $user = \Auth::user();

        $like = Like::where("user_id", $user->id)->where("image_id", $image_id)->first();

        if($like)
            $like->delete();
    }

    public function likes() {
        $user = \Auth::user();
        $likes = Like::where("user_id", $user->id)->orderBy("id", "desc")->paginate(5);

        return view("like.likes", [
            "likes" => $likes
        ]);
    }
}
