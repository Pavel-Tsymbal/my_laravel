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

Route::get('/', 'ArticlesController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Blog*/
Route::get('article/{id}/{slug}.html','ArticlesController@showArticle')
    ->where('id','\d+')
    ->name('blog.article');

/* Admin*/
Route::group(['middleware' => 'auth'],function (){
    Route::group(['middleware' => 'admin','prefix' => 'admin'],function (){
        Route::get('/', 'Admin\AccountController@index')->name('admin');

        /* Categories */
        Route::get('/categories','Admin\CategoriesController@index')->name('categories');
        Route::get('/categories/add', 'Admin\CategoriesController@addCategory')->name('categories.add');
        Route::post('/categories/add', 'Admin\CategoriesController@addRequestCategory');
        Route::get('/categories/edit/{id}', 'Admin\CategoriesController@editCategory')
            ->where('id','\d+')
            ->name('categories.edit');
        Route::post('/categories/edit/{id}', 'Admin\CategoriesController@editRequestCategory')
            ->where('id','\d+');
        Route::get('/categories/delete/{id}', 'Admin\CategoriesController@deleteCategory')
            ->where('id','\d+')
            ->name('categories.delete');

        /* Articles */
        Route::get('/articles','Admin\ArticlesController@index')->name('articles');
        Route::get('/articles/add', 'Admin\ArticlesController@addArticle')->name('articles.add');
        Route::post('/articles/add', 'Admin\ArticlesController@addRequestArticle');
        Route::get('/articles/edit/{id}', 'Admin\ArticlesController@editArticle')
            ->where('id','\d+')
            ->name('articles.edit');
        Route::post('/articles/edit/{id}', 'Admin\ArticlesController@editRequestArticle')
            ->where('id','\d+');
        Route::get('/articles/delete/{id}', 'Admin\ArticlesController@deleteArticle')
            ->where('id','\d+')
            ->name('articles.delete');

        /* Users */
        Route::get('/users', 'Admin\UserController@index')->name('users');
    });
});

