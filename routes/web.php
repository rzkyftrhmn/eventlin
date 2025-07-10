<?php

use App\Http\Controllers\DetailRundownController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RundownController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('proposals', ProposalController::class);
Route::resource('persetujuans', PersetujuanController::class);
Route::get('persetujuans/{id_proposal}/edit', [PersetujuanController::class, 'edit'])->name('persetujuans.edit');
Route::put('persetujuans/{id_proposal}', [PersetujuanController::class, 'update'])->name('persetujuans.update');
Route::get('persetujuans', [PersetujuanController::class, 'index'])->name('persetujuans.index');
Route::get('/persetujuans/{id}/edit-status', [PersetujuanController::class, 'editStatus'])->name('persetujuans.editStatus');
Route::put('/persetujuans/{id}/update-status', [PersetujuanController::class, 'updateStatus'])->name('persetujuans.updateStatus');

Route::get('/proposals/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])->name('rundowns.createRundown');
Route::post('/rundowns', [RundownController::class, 'store'])->name('rundowns.store');
Route::get('/rundowns/{id}', [RundownController::class, 'show'])->name('rundowns.show');
Route::get('/rundowns/{id}/edit', [RundownController::class, 'edit'])->name('rundowns.edit');
Route::put('/rundowns/{id}', [RundownController::class, 'update'])->name('rundowns.update');
Route::delete('/rundowns/{id}', [RundownController::class, 'destroy'])->name('rundowns.destroy');

Route::get('/rundowns/{id_rundown}/details/create', [DetailRundownController::class, 'create'])->name('detail-rundowns.create');
Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
Route::get('/detail-rundowns/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundowns.edit');
Route::put('/detail-rundowns/{id}', [DetailRundownController::class, 'update'])->name('detail-rundowns.update');
Route::delete('/detail-rundowns/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundowns.destroy');

// Detail Rundown Routes
// Route::get('/rundowns/{id_rundown}/detail-rundown/create', [DetailRundownController::class, 'create'])->name('detail-rundown.create');
// Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
// Route::get('/detail-rundown/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundown.edit');
// Route::put('/detail-rundown/{id}', [DetailRundownController::class, 'update'])->name('detail-rundown.update');
// Route::delete('/detail-rundown/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundown.destroy');




