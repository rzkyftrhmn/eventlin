<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthPanitiaController;
use App\Http\Controllers\AuthPesertaController;
use App\Http\Controllers\DetailRundownController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KuotaPendaftaranController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RundownController;
use App\Http\Controllers\PanitiasController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

// Dashboard (jika ada middleware, sebaiknya pakai auth + role check)
Route::get('/', function () {
    return "<h1>dashboard</h1>";
});

// Auth routes for admin
// kondisi ketika user belum login
Route::middleware('guest:admin')->group(function () {
    Route::get('/login/admin', [AuthAdminController::class, 'showLoginForm'])->name('admin.loginForm');
    Route::post('/login/admin', [AuthAdminController::class, 'login'])->name('admin.login');
    Route::get('/register/admin', [AuthAdminController::class, 'showRegisterForm'])->name('admin.registerForm');
    Route::post('/register/admin', [AuthAdminController::class, 'register'])->name('admin.register');
});

// kondisi ketika admin sudah login
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard/admin', [AuthAdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout/admin', [AuthAdminController::class, 'logout'])->name('admin.logout');
});

// Auth routes for panitia
// kondisi ketika panitia belum login
Route::middleware('guest:panitia')->group(function () {
    Route::get('/login/panitia', [AuthPanitiaController::class, 'showLoginForm'])->name('panitia.loginForm');
    Route::post('/login/panitia', [AuthPanitiaController::class, 'login'])->name('panitia.login');
});

// kondisi ketika panitia sudah login
Route::middleware(['auth:panitia'])->group(function () {
    Route::get('/dashboard/panitia', [AuthPanitiaController::class, 'dashboard'])->name('panitia.dashboard');
    Route::post('/logout/panitia', [AuthPanitiaController::class, 'logout'])->name('panitia.logout');
    Route::get('/proposal-ku', [ProposalController::class, 'showByPanitia'])->name('proposal.panitia.show');
    
    // Routes for ketua, sekretaris, bendahara
    Route::middleware(['cek.jabatan:ketua,sekretaris,bendahara'])->group(function () {
        Route::get('/panitia/proposals/{id}', [ProposalController::class, 'show'])
            ->name('proposal.superpanitia.show');
    });

});

// Auth routes for peserta 
// Pendaftaran peserta (hanya jika kuota masih ada dan status = Buka)
// kondisi ketika user belum login
Route::middleware('guest:peserta')->group(function () {
    Route::get('/daftar', [AuthPesertaController::class, 'pilihProposal'])->name('peserta.pilihProposal');
    Route::get('/daftar/{id_proposal}', [AuthPesertaController::class, 'showRegisterForm'])->name('peserta.formRegister');
    Route::post('/daftar/{id_proposal}', [AuthPesertaController::class, 'register'])->name('peserta.register');

    Route::get('/login/peserta', [AuthPesertaController::class, 'showLoginForm'])->name('peserta.loginForm');
    Route::post('/login/peserta', [AuthPesertaController::class, 'login'])->name('peserta.login');
});

//KONDISI ketika user sudah login
Route::middleware('auth:peserta')->group(function () {
    Route::get('/dashboard/peserta', [AuthPesertaController::class, 'dashboard'])->name('peserta.dashboard');
    Route::post('/logout/peserta', [AuthPesertaController::class, 'logout'])->name('peserta.logout');
});






// Admin management
Route::resource('admins', AdminController::class);

// Proposal management (semua)
Route::resource('proposals', ProposalController::class);

// Persetujuan untuk semua proposal
Route::resource('persetujuans', PersetujuanController::class);

// Divisi hanya untuk admin
Route::resource('divisis', DivisiController::class);

// Rundown semua proposal
Route::get('/proposals/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])->name('rundowns.createRundown');
Route::post('/rundowns', [RundownController::class, 'store'])->name('rundowns.store');
Route::get('/rundowns/{id}', [RundownController::class, 'show'])->name('rundowns.show');
Route::get('/rundowns/{id}/edit', [RundownController::class, 'edit'])->name('rundowns.edit');
Route::put('/rundowns/{id}', [RundownController::class, 'update'])->name('rundowns.update');
Route::delete('/rundowns/{id}', [RundownController::class, 'destroy'])->name('rundowns.destroy');

// Detail rundown semua
Route::get('/rundowns/{id_rundown}/details/create', [DetailRundownController::class, 'create'])->name('detail-rundowns.create');
Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
Route::get('/detail-rundowns/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundowns.edit');
Route::put('/detail-rundowns/{id}', [DetailRundownController::class, 'update'])->name('detail-rundowns.update');
Route::delete('/detail-rundowns/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundowns.destroy');

// Panitia semua proposal
Route::get('/proposals/{id_proposal}/panitia', [PanitiasController::class, 'index'])->name('panitia.index');
Route::get('/proposals/{id_proposal}/panitia/create', [PanitiasController::class, 'create'])->name('panitia.create');
Route::post('/proposals/{id_proposal}/panitia', [PanitiasController::class, 'store'])->name('panitia.store');
Route::get('/panitia/{id_panitia}/edit', [PanitiasController::class, 'edit'])->name('panitia.edit');
Route::put('/panitia/{id_panitia}', [PanitiasController::class, 'update'])->name('panitia.update');
Route::delete('/panitia/{id_panitia}', [PanitiasController::class, 'destroy'])->name('panitia.destroy');

// Kuota
Route::resource('kuota', KuotaPendaftaranController::class);

// Semua peserta
Route::resource('pesertas', PesertaController::class);

//panitia(akademik)
Route::get('persetujuans', [PersetujuanController::class, 'index'])->name('persetujuans.index');
Route::get('persetujuans/{id_proposal}/edit', [PersetujuanController::class, 'edit'])->name('persetujuans.edit');
Route::put('persetujuans/{id_proposal}', [PersetujuanController::class, 'update'])->name('persetujuans.update');

// Persetujuan internal (Ketua & Sekretaris)
Route::get('/persetujuans/{id}/edit-status', [PersetujuanController::class, 'editStatus'])->name('persetujuans.editStatus');
Route::put('/persetujuans/{id}/update-status', [PersetujuanController::class, 'updateStatus'])->name('persetujuans.updateStatus');
Route::get('/proposal-ku', [ProposalController::class, 'showByPanitia'])->name('proposal.panitia.show');

// Rundown (panitia acara)
Route::get('/proposals/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])->name('rundowns.createRundown');
Route::post('/rundowns', [RundownController::class, 'store'])->name('rundowns.store');
Route::get('/rundowns/{id}', [RundownController::class, 'show'])->name('rundowns.show');
Route::get('/rundowns/{id}/edit', [RundownController::class, 'edit'])->name('rundowns.edit');
Route::put('/rundowns/{id}', [RundownController::class, 'update'])->name('rundowns.update');
Route::delete('/rundowns/{id}', [RundownController::class, 'destroy'])->name('rundowns.destroy');

// Detail rundown
Route::get('/rundowns/{id_rundown}/details/create', [DetailRundownController::class, 'create'])->name('detail-rundowns.create');
Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
Route::get('/detail-rundowns/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundowns.edit');
Route::put('/detail-rundowns/{id}', [DetailRundownController::class, 'update'])->name('detail-rundowns.update');
Route::delete('/detail-rundowns/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundowns.destroy');

// Panitia hanya untuk proposal mereka
Route::get('proposals/{id_proposal}/panitia', [PanitiasController::class, 'indexByProposal'])->name('panitia.byProposal');


Route::get('/proposals/{id_proposal}/peserta/create', [PesertaController::class, 'create'])->name('peserta.create');
Route::post('/proposals/{id_proposal}/peserta', [PesertaController::class, 'store'])->name('peserta.store');

// Lihat semua peserta pada proposal (untuk proposal public atau terdaftar)
Route::get('proposals/{id_proposal}/peserta', [PesertaController::class, 'indexByProposal'])->name('peserta.byProposal');

// Update data peserta (jika diizinkan)
Route::get('/peserta/{nim}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
Route::put('/peserta/{nim}', [PesertaController::class, 'update'])->name('peserta.update');


