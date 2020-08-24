<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get("/configuration", "UserController@config")->name("config");
Route::post("/user/update", "UserController@update")->name("user.update");
Route::get("/user/avatar/{filename}", "UserController@getImage")->name("user.avatar");
Route::get("/profile/{id}", "UserController@profile")->name("user.profile");
Route::get("/people", "UserController@index")->name("user.index");

Route::get("/image/upload", "ImageController@create")->name("image.create");
Route::post("/image/save", "ImageController@save")->name("image.save");
Route::get("/image/file/{filename}", "ImageController@get")->name("image.get");
Route::get("/image/{id}", "ImageController@detail")->name("image.detail");
Route::get("/image/edit/{id}", "ImageController@edit")->name("image.edit");
Route::post("/image/update", "ImageController@update")->name("image.update");
Route::get("/image/delete/{id}", "ImageController@delete")->name("image.delete");

Route::post("/comment/save", "CommentController@save")->name("comment.save");
Route::get("/comment/delete/{id}", "CommentController@delete")->name("comment.delete");

Route::get("/like/{image_id}", "LikeController@like")->name("like");
Route::get("/dislike/{image_id}", "LikeController@dislike")->name("dislike");
Route::get("/likes", "LikeController@likes")->name("likes");
