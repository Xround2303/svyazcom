<?php

use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/{vue_capture?}', function (\Illuminate\Http\Request $request) {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*');

