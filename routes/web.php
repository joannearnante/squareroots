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

Route::get('/about', function () {
    return view('about');
});

Route::get('/howtoorder', function () {
    return view('howtoorder');
});

Route::get('/join', function () {
    return view('join');
});

/*Route::get('/registry', function () {
    return view('admin.registry');
});*/

Auth::routes();

Route::resource('members', 'MemberController');

Route::resource('products', 'ProductController');

Route::resource('categories', 'CategoryController');

Route::resource('orders', 'OrderController');

Route::post('subtract/{name}', 'ProductController@subtract');

Route::post('add/{name}', 'ProductController@add');

Route::post('disableall/{name}', 'ProductController@disableall');

Route::get('sortbyprice', 'ProductController@sortbyprice');

Route::get('sortbyname', 'ProductController@sortbyname');

Route::get('sortbycategory', 'ProductController@sortbycategory');

/*Route::get('sorthistory', 'ProductController@sorthistorybyprice');*/