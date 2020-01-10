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

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => true,
]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Usuários
    Route::resource('users', 'UserController');

    // Categorias
    Route::resource('categories', 'CategoryController');

    // Tags
    Route::resource('tags', 'TagController');

    // Artigos
    Route::resource('articles', 'ArticleController');
});
