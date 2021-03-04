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
Auth::routes();
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::get('/search', 'SearchArticleController')->name('articles.search');
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{user}', 'UserController@show')->name('show');
    Route::middleware('auth')->group(function () {
        Route::put('/{user}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{user}/follow', 'UserController@unfollow')->name('unfollow');
    });
});