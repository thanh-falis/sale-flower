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


Route::get('/', [
    'as'=>'trang-chu',
    'uses'=>'PageController@Index'
]);

// Route Admin
Route::get('/admin', 'UserController@getLoginAdmin');
Route::get('admin/login','UserController@getLoginAdmin');
Route::post('admin/login','UserController@postLoginAdmin');
Route::get('admin/logout','UserController@LogoutAdmin');

Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function(){

    Route::group(['prefix'=>'producttype'], function(){
        Route::get('list', 'ProductTypeController@getList');
        Route::get('edit/{id}', 'ProductTypeController@getEdit');
        Route::post('edit/{id}', 'ProductTypeController@postEdit');
        Route::get('add', 'ProductTypeController@getAdd');
        Route::post('add', 'ProductTypeController@postAdd');
        Route::get('delete/{id}', 'ProductTypeController@Delete');
    });

    Route::group(['prefix'=>'product'], function(){
        Route::get('list', 'ProductController@getList');
        Route::get('edit/{id}', 'ProductController@getEdit');
        Route::post('edit/{id}', 'ProductController@postEdit');
        Route::get('add', 'ProductController@getAdd');
        Route::post('add', 'ProductController@postAdd');
        Route::get('delete/{id}', 'ProductController@Delete');
    });

    Route::group(['prefix'=>'bill'], function(){
        Route::get('list', 'BillController@getList');
        Route::get('edit/{id}', 'BillController@getEdit');
        Route::post('edit/{id}', 'BillController@postEdit');
        Route::get('delete/{id}', 'BillController@Delete');
    });

    Route::group(['prefix'=>'billdetail'], function(){
        Route::get('list', 'BillDetailController@getList');
        Route::get('delete/{id}', 'BillDetailController@Delete');
    });

    Route::group(['prefix'=>'customer'], function(){
        Route::get('list', 'CustomerController@getList');
        Route::get('edit/{id}', 'CustomerController@getEdit');
        Route::post('edit/{id}', 'CustomerController@postEdit');
        Route::get('delete/{id}', 'CustomerController@Delete');
    });

    Route::group(['prefix'=>'slide'], function(){
        Route::get('list', 'SlideController@getList');
        Route::get('edit/{id}', 'SlideController@getEdit');
        Route::post('edit/{id}', 'SlideController@postEdit');
        Route::get('add', 'SlideController@getAdd');
        Route::post('add', 'SlideController@postAdd');
        Route::get('delete/{id}', 'SlideController@Delete');
    });

    Route::group(['prefix'=>'user'], function(){
        Route::get('list', 'UserController@getList');
        Route::get('edit/{id}', 'UserController@getEdit');
        Route::post('edit/{id}', 'UserController@postEdit');
        Route::get('add', 'UserController@getAdd');
        Route::post('add', 'UserController@postAdd');
        Route::get('change-password/{id}', 'UserController@getChange_Password');    
        Route::post('change-password/{id}', 'UserController@postChange_Password');    
        Route::get('delete/{id}', 'UserController@Delete');
    });
});
//End Roure Admin

Route::get('loai-san-pham/{type}',[
    'as' => 'loaisanpham',
    'uses' => 'PageController@Loaisanpham'
]);

Route::get('chi-tiet-san-pham/{id}',[
    'as' => 'chitietsanpham',
    'uses' => 'PageController@ChitietSP'
]);

Route::get('lien-he',[
    'as' => 'lienhe',
    'uses' => 'PageController@lienhe'
]);

Route::get('gioi-thieu',[
    'as' => 'gioithieu',
    'uses' => 'PageController@Gioithieu'
]);

Route::get('add-to-cart/{id}',[
    'as'=>'themgiohang',
    'uses'=>'PageController@Addcart'
]);

Route::get('dell-cart/{id}',[
    'as'=>'xoagiohang',
    'uses'=>'PageController@DeleteCart'
]);

Route::get('dat-hang',[
    'as'=>'dathang',
    'uses'=>'PageController@getCheckout'
]);

Route::post('dat-hang',[
    'as'=>'dathang',
    'uses'=>'PageController@postCheckout'
]);

Route::get('login',[
    'as'=>'login',
    'uses'=>'PageController@getLogin'
]);

Route::post('login',[
    'as'=>'login',
    'uses'=>'PageController@postLogin'
]);

Route::get('register',[
    'as'=>'register',
    'uses'=>'PageController@getRegister'
]);

Route::post('register',[
    'as'=>'register',
    'uses'=>'PageController@postRegister'
]);

Route::get('logout',[
    'as'=>'logout',
    'uses'=>'PageController@Logout'
]);

Route::get('search',[
    'as'=>'search',
    'uses'=>'PageController@Search'
]);


//send mail

Route::get('sendmail', 'PageController@Sendmail');