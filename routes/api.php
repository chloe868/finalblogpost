<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Posts
Route::get('posts/{user_id}', 'PostController@index');
Route::get('getposts', 'PostController@retrieve');
Route::post('createpost', 'PostController@createpost');
Route::get('deletePost/{id}', 'PostController@deletePost');
Route::post('updatePost', 'PostController@editPosts');

//Comments
Route::get('getcomments', 'CommentController@retrievecomment');
Route::post('createcomments', 'CommentController@createcomment');