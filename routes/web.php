<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('proposals', \App\Http\Controllers\ProposalController::class);

