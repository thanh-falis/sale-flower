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

Route::get('loai-san-pham',[
    'as' => 'loaisanpham',
    'uses' => 'PageController@Loaisanpham'
]);

Route::get('chi-tiet-san-pham',[
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
