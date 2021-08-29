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

Route::get("/insert-person", "PersonController@render");
Route::post("/insert-person", "PersonController@insertPerson");
Route::post("/get-person", "PersonController@getPerson");
Route::post("/edit-person", "PersonController@editPerson");
Route::post("/delete-person", "PersonController@deletePerson");
