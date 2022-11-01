<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('/','feed');

Route::group(['namespace'=>'App\Http\Controllers'],function($router){
    $router->match(methods:['get','post'],uri:'/auth',action: 'AuthController@login')->name('login');
    $router->match(methods:['get','post'],uri:'/auth/register',action: 'AuthController@register');

    $router->group(['middleware'=>'auth'],function($router){
        $router->get('/subscriptions', 'SubscriptionController@index')->name('subscriptions');
        $router->get('/post/{post}/subscribe','SubscriptionController@subscribe')->name('subscribe');

        $router->get('/feed','PostController@feed')->name('feed');
        $router->view('/post', 'post.form')->name('novo');
        $router->post('/post','PostController@create');
        $router->get('/post/{post}','PostController@show')->name('post');
        $router->get('/post/{post}/delete','PostController@delete')->name('post.delete');
        $router->match(['get','post'],'/post/{post}/edit/{operation?}','PostController@edit')->name('post.edit');

        $router->post('/post/{post}/comments', 'AnalysisController@create')->name('analysis.create');
        $router->get('/post/{post}/comments','AnalysisController@form')->name('analysis.form');

        $router->get('/auth/logout',function(Request $request){
            Auth::logout();
            return redirect('/auth');
        })->name('logout');
    });
});
