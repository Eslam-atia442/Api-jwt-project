<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['api','checkpassword'], 'namespace' => 'Api'], function () {


    Route::group(['prefix' => 'admin','namespace'=>'Admin'],function (){
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout','AuthController@logout') -> middleware  ([ 'auth.guard:admin-api' ]);
        Route::post('profile','AuthController@profile') -> middleware  ([ 'auth.guard:admin-api' ]);
        Route::post('hello',function (){return 'hello';}) -> middleware    ([  'auth.guard:admin-api' ]);



    });


    Route::group([['prefix' => 'User'],'middleware' =>['auth.guard:admin-api']],function(){

            Route::post('profile',function (){
           return 'only user';
        });

    });
});









