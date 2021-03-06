<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// public routes
Route::name('images')->get('/images');

Route::name('home')->get('/', "HomeController@show");
Route::name('login')->get('login', "Login\ShowController@show");
Route::name('login/post')->post('login/post', "Login\PostController@post");
Route::name('logout')->any('logout', "Login\LogoutController@logout");
Route::name('join')->get('join', "Join\ShowController@show");
Route::name('join/post')->post('join/post', "Join\PostController@post");
Route::name('forum-board')->get('forum/{board}', "Forum\Board\ShowController@show");
Route::name('forum-board')->get('forum/{board}/new', "Forum\Board\New\ShowController@show");
Route::name('forum-topic')->get('forum/{board}/{topic}', "Forum\Topic\ShowController@show");
Route::name('news-current')->get('news', "News\CurrentController@show");
Route::name('news-archived')->get('news/{date}', "News\ArchivedController@show");
Route::name('profile')->get('users/{username}', "Profile\UserController@show");
Route::name('reviews')->get('reviews', "ReviewsController@show");
Route::name('review')->get('reviews/{title}', "ReviewController@show");

Route::group(['middleware' => 'auth'], function () {
    Route::name('comment/post')->post('comment/post', "Comments\PostController@post");
    Route::name('comment/like')->post('comment/like', "Comments\LikeController@post");
    Route::name('comment/preview')->post('comment/preview', "Comments\PreviewController@show");

    Route::group(['middleware' => 'validate'], function () {
        Route::name('news/post')->post('news/post', "News\PostController@post");
    });

    Route::name('news/click')->post('news/click', "News\ClickController@click");
});

// routes with permissions - should all have 'before' => 'auth'
Route::any(
    'chat',
    ['before' => 'auth:TEST', 'uses' => "ChatController@chat"]
);
Route::any(
    'chat/{username}',
    ['before' => 'auth:TEST', "ChatController@chat"]
);
Route::post(
    'chatPost',
    ['before' => 'auth:TEST', "ChatController@chatPost"]
);
Route::post(
    'messages/{username}',
    ['before' => 'auth:TEST', "ChatController@messages"]
);
