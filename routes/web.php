<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Route::get('home', function () {
    return view('front.layouts.app');
});
;