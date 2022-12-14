<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

Auth::routes();

Route::get('/', 'App\Http\Controllers\ArticleController@index')->name('articles.index')->middleware('auth');
Route::resource('/articles', 'App\Http\Controllers\ArticleController')->except(['index','show'])
        ->middleware('auth');
Route::resource('/articles', 'App\Http\Controllers\ArticleController')->only(['show']);  
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'App\Http\Controllers\ArticleController@like')
            ->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'App\Http\Controllers\ArticleController@unlike')
            ->name('unlike')->middleware('auth');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'App\Http\Controllers\UserController@show')->name('show');
    Route::get('/{name}/likes', 'App\Http\Controllers\UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'App\Http\Controllers\UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'App\Http\Controllers\UserController@followers')->name('followers');
    Route::get('/{name}/edit', 'App\Http\Controllers\UserController@edit')->name('edit');
    Route::post('/{name}/edit','App\Http\Controllers\UserController@update')->name('update');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'App\Http\Controllers\UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'App\Http\Controllers\UserController@unfollow')->name('unfollow');
    });
    Route::get('/{name}/statuses', 'App\Http\Controllers\StatusController@search')->name('statuses.search');
    Route::post('/{name}/statuses/sort', 'App\Http\Controllers\StatusController@sort')->name('statuses.sort');
});

Route::post('/articles/{comment_id}/comments','App\Http\Controllers\CommentsController@store');
Route::post('/articles/{comment_id}', 'App\Http\Controllers\CommentsController@destroy')->name('comment.destroy');

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::get('rooms', 'App\Http\Controllers\ChatController@rooms')->name('chat.rooms');
    Route::post('show', 'App\Http\Controllers\ChatController@show')->name('chat.show');
    Route::get('messages', [App\Http\Controllers\ChatController::class, 'get']);
    Route::post('messages', [App\Http\Controllers\ChatController::class, 'send']);
});

Route::get('/setting', 'App\Http\Controllers\SetController@settings')->name('set.setting');

Route::get('/notices','App\Http\Controllers\NoticeController@show')->name('notices.show');
Route::post('/notices','App\Http\Controllers\NoticeController@destroy')->name('notices.destroy');