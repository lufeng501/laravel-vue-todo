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

// 获取csrf的token值
Route::get('getCsftToken',function () {
    return csrf_token();
});

Route::group(['prefix' => 'todo'], function () {
    Route::get('getTodoLists', 'Todo\IndexController@getTodoLists');
    Route::get('getTodoItemDetails/{id}', 'Todo\IndexController@getTodoItemDetails');
    Route::post('addTodoItem/{id?}', 'Todo\IndexController@addTodoItem');
    Route::post('delete/{id}', 'Todo\IndexController@delete');
});