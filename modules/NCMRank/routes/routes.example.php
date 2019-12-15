<?php

/*
 * Examples of Laravel routes for NCMRank.
 */
Route::get('/ncm_rank/data/{user}', 'NCMRankController@data');
Route::get('/ncm_rank', 'NCMRankController@index');
