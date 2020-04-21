<?php

// Route::get("/", "HomeController@home");
// Route::get("/manifest.json", "HomeController@manifest");

// Route::get("invite_code", "InviteCodeController@show");
Route::post("invite_code/verify", "InviteCodeController@verify");

Route::post("login", "UserController@login");
Route::any("logout", "UserController@logout");
Route::get("login/validateCode", "UserController@validateCode");
Route::get("login/token", "UserController@getToken");

Route::get("user/info", "UserController@userInfo");
Route::get("user/score", "UserController@userScore");
Route::get("user/photo", "UserController@photo");
Route::get("user/rank", "UserController@rank");
Route::get("user/records", "UserController@records");
Route::get("user/templates", "UserController@templates");

// Route::get("terms", "StaticController@terms")->name("terms");
