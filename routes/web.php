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

Auth::routes();

/**
 * Routes of NCMRank
 */
Route::group([
    "prefix" => LaravelLocalization::setLocale(),
    "middleware" => ["localeSessionRedirect", "localizationRedirect"],
    "name" => "ncmrank.",
    "namespace" => "\JingBh\NCMRank"
], function() {
    Route::get('/ncm_rank/data/{user}', 'NCMRankController@data');
    Route::get('/ncm_rank', 'NCMRankController@index');
});
