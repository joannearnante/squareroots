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
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

/*Route::get('/registry', function () {
    return view('admin.registry');
});*/

Auth::routes();

Route::resource('members', 'MemberController');

Route::resource('products', 'ProductController');

Route::resource('categories', 'CategoryController');

/*Route::get('/products', 'SortController@stocksummary');*/
