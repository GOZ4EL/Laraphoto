<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Image;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *hb
     * @return Factory|Application|Response|View
     */
    public function index() {
        $images = Image::orderBy("id", "desc")->paginate(5);

        return view("home", [
            "images" => $images
        ]);
    }
}
