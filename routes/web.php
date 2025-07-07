<?php

use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('proposals', \App\Http\Controllers\ProposalController::class);
Route::get('/proposals/search', [ProposalController::class, 'search'])->name('proposals.search');

