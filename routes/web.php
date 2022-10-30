<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'App\Http\Controllers'],function($router){
    $router->get(uri:'/auth',action: 'AuthController@login');
    $router->post(uri:'/auth',action: 'AuthController@login');
    $router->get(uri:'/auth/register',action: 'AuthController@register');
    $router->post(uri:'/auth/register',action: 'AuthController@register');
});
