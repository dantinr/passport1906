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


Route::get('/login','User\LoginController@webLogin');      // web网站登录
Route::post('/login','User\LoginController@webLoginDo');   // web网站登录


//处理API授权
Route::prefix('/api')->group(function(){
	route::post('/login','User\LoginController@apiLogin');
});
