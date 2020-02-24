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

/**
 *cheater route to load welcome page
 */
Route::get('/', function () {
    return view('welcome');
});


/**
 * all the ajax call backs
 */
Route::get('/ajax/topBooks', 'AjaxController@topBooks');
Route::get('/ajax/showBook/{id}', 'AjaxController@showBook');
Route::get('/ajax/deleteSale/{id}', 'AjaxController@deleteSale');
Route::get('/ajax/deleteBook/{id}', 'AjaxController@deleteBook');
Route::get('/ajax/editBook/{id}', 'AjaxController@editBook');
Route::post('/ajax/purchaseBook/{id}', 'AjaxController@purchaseBook');
Route::post('/ajax/saveBook', 'AjaxController@saveBook');
