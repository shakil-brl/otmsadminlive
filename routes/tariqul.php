<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group([], function () {
    Route::post('set-token', function (Request $request) {
        Session::put('accessToken', $request->accessToken);
        Session::put('tokenType', $request->tokenType);
        return 'success';
    });
});


Route::group(['prefix' => 'test'], function () {
    Route::view('batch_list', 'att.batch_list');
    Route::view('schedule_create', 'att.schedule_create')->name('a1');
    Route::view('schedule_list', 'att.schedule_list')->name('a2');
    Route::view('student_list', 'att.student_list')->name('a3');
});
