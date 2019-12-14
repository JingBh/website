<?php

Route::get('/ncm_rank/data/{user}', 'JingBh\NCMRank\NCMRankController@data');

Route::get('/ncm_rank', 'JingBh\NCMRank\NCMRankController@index');
