<?php

use App\Http\Controllers\AbsensiAksesDivisiController;
use App\Http\Controllers\AbsensiPanitiaController;
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
use App\Http\Controllers\PembayaranTiketController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

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
//auth
    //dashboard admin
    Route::get('/dashboard/admin', [AuthAdminController::class, 'dashboard'])->name('admin.dashboard');
    //logout admin
    Route::post('/logout/admin', [AuthAdminController::class, 'logout'])->name('admin.logout');

// Admin management
    Route::resource('admins', AdminController::class);

// Divisi hanya untuk admin
    Route::resource('divisis', DivisiController::class);

//panitia
    Route::resource('panitia', PanitiasController::class);

//peserta
    Route::resource('peserta', PesertaController::class);

//proposal
    // Proposal management (semua)
    Route::resource('proposals', ProposalController::class);

//persetujuan
    // Persetujuan untuk semua proposal
    Route::resource('persetujuans', PersetujuanController::class);
    Route::get('/persetujuans/{id}/edit-status', [PersetujuanController::class, 'editStatus'])->name('persetujuans.editStatus');
    Route::put('/persetujuans/{id}/update-status', [PersetujuanController::class, 'updateStatus'])->name('persetujuans.updateStatus');

//Panitia
    // index panitia based on proposal    
    Route::get('proposals/{id_proposal}/panitia', [PanitiasController::class, 'indexByProposal'])
        ->name('panitia.byProposal');
    // create panitia
    Route::get('/proposals/{id_proposal}/panitia/create', [PanitiasController::class, 'create'])
        ->name('panitia.create');
    // store panitia
    Route::post('/proposals/{id_proposal}/panitia', [PanitiasController::class, 'store'])
        ->name('panitia.store');
    // edit panitia
    Route::get('/panitia/{id_panitia}/edit', [PanitiasController::class, 'edit'])
        ->name('panitia.edit');
    // update panitia
    Route::put('/panitia/{id_panitia}', [PanitiasController::class, 'update'])
        ->name('panitia.update');
    // delete panitia
    Route::delete('/panitia/{id_panitia}', [PanitiasController::class, 'destroy'])
        ->name('panitia.destroy');

// rundown
    // create Rundown
    Route::get('/proposals/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])
        ->name('rundowns.createRundown');

// pemilihan absensi
    Route::post('/proposal/{id_proposal}/atur-absensi-divisi', [AbsensiAksesDivisiController::class, 'store'])->name('absensiDivisi.store');

});




// Auth routes for panitia
// kondisi ketika panitia belum login
Route::middleware('guest:panitia')->group(function () {
    Route::get('/login/panitia', [AuthPanitiaController::class, 'showLoginForm'])->name('panitia.loginForm');
    Route::post('/login/panitia', [AuthPanitiaController::class, 'login'])->name('panitia.login');
    
});

// kondisi ketika panitia sudah login
Route::middleware(['auth:panitia'])->group(function () {
    //dashboard panitia
    Route::get('/dashboard/panitia', [AuthPanitiaController::class, 'dashboard'])->name('panitia.dashboard');
    //logout
    Route::post('/logout/panitia', [AuthPanitiaController::class, 'logout'])->name('panitia.logout');

    Route::get('/panitia/profile/{id_panitia}', [PanitiasController::class, 'show'])->name('panitia.profile');


    //tampilan proposal
    Route::get('/proposal-ku', [ProposalController::class, 'showByPanitia'])->name('proposal.panitia.show');
    
    Route::get('/panitia/superproposals/{id}', [ProposalController::class, 'show'])
        ->name('proposal.superpanitia.show');
    
    Route::get('/rundowns/panitia/{id}/export-pdf', [RundownController::class, 'exportPdf'])
        ->name('rundowns.panitia.export.pdf');
    
        // Routes for ketua, sekretaris, bendahara
    Route::middleware(['cek.jabatan:ketua,sekretaris,bendahara'])->group(function () {
        //show proposal

    //persetujuan
        // Persetujuan internal (Ketua & Sekretaris)
        Route::get('/persetujuans/panitia/{id}/edit-status', [PersetujuanController::class, 'editStatus'])
            ->name('persetujuans.SupereditStatus');
        Route::put('/persetujuans/super/{id}/update-status', [PersetujuanController::class, 'updateStatus'])
            ->name('persetujuans.SuperupdateStatus');

    //panitia
        // index panitia
        Route::get('proposals/{id_proposal}/panitiaSuper', [PanitiasController::class, 'indexByProposal'])
            ->name('panitia.SuperbyProposal');
        // create panitia    
        Route::get('/proposals/{id_proposal}/panitiaSuper/create', [PanitiasController::class, 'create'])
            ->name('panitia.Supercreate');
        // store panitia
        Route::post('/proposals/{id_proposal}/panitiaSuper', [PanitiasController::class, 'store'])
            ->name('panitia.Superstore');    
        // edit panitia    
        Route::get('/panitiaSuper/{id_panitia}/edit', [PanitiasController::class, 'edit'])
            ->name('panitia.Superedit');
        //update panitia    
        Route::put('/panitiaSuper/{id_panitia}', [PanitiasController::class, 'update'])
            ->name('panitia.Superupdate');
        //destroy panitia    
        Route::delete('/panitiaSuper/{id_panitia}', [PanitiasController::class, 'destroy'])
            ->name('panitia.Superdestroy');
    //rundown
        Route::get('/proposals/panitia/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])
            ->name('rundowns.SuperCreateRundown');
        
    });

    //routes panitia bendahara
    Route::middleware(['cek.jabatan:bendahara'])->group(function(){
         Route::get('/halaman-verifikisi/{id}', [PembayaranTiketController::class, 'index'])->name('pembayaran.verifikasi');
         Route::put('/verifikasi-pembayaran/{id}', [PembayaranTiketController::class, 'updateStatus'])->name('verifikasi.pembayaran.update');

    });

    //routes panitia biasa
    Route::middleware(['cek.jabatan:panitia'])->group(function () {
        //show panitia
        Route::get('/panitia/proposals/{id}/read', [ProposalController::class, 'showPanitia'])
            ->name('proposal.panitia.show.read');
        //rundown
        Route::get('/rundowns/panitia/{id}', [RundownController::class, 'show'])
            ->name('rundowns.panitia.show');
        // Halaman scan QR untuk absensi berdasarkan rundown
        Route::get('/absensi/scan/{id_rundown}', [AbsensiPanitiaController::class, 'scanForm'])
            ->name('absensi.scan');
        // Menyimpan data absensi setelah scan QR
        Route::post('/absensi/store', [AbsensiPanitiaController::class, 'store'])
            ->name('absensi.store');
        // Halaman rekap absensi berdasarkan rundown
        Route::get('/absensi/rundown/{id_rundown}', [AbsensiPanitiaController::class, 'rekap'])
            ->name('absensi.rekap');
        // Halaman input manual absensi
        Route::post('/absensi/manual', [AbsensiPanitiaController::class, 'manual'])
            ->name('absensi.manual'); // untuk input manual
        
    });

    //routes panitia akademik
    Route::middleware(['auth:panitia', 'cek.jabatan:akademik'])->group(function () {
        //index persetujuan
        Route::get('persetujuansAkademik', [PersetujuanController::class, 'index'])->name('persetujuans.indexAkademik');
        //open edit from persetujuan
        Route::get('persetujuansAkademik/{id_proposal}/edit', [PersetujuanController::class, 'edit'])->name('persetujuans.editAkademik');
        //update persetujuan
        Route::put('persetujuansAkademik/{id_proposal}', [PersetujuanController::class, 'update'])->name('persetujuans.updateAkademik');
    });

});

// Auth routes for peserta 
// Pendaftaran peserta (hanya jika kuota masih ada dan status = Buka)
// kondisi ketika user belum login
Route::middleware('guest:peserta')->group(function () {
    Route::get('/dashboard/peserta', [AuthPesertaController::class, 'dashboard'])->name('peserta.content_dashboard');

    Route::get('/', [AuthPesertaController::class, 'pilihProposal'])->name('peserta.pilihProposal');
    //memilih proposal
    Route::get('/daftar/{id_proposal}', [AuthPesertaController::class, 'showRegisterForm'])->name('peserta.formRegister');
    Route::post('/daftar/{id_proposal}', [AuthPesertaController::class, 'register'])->name('peserta.register');

    Route::get('/login/peserta', [AuthPesertaController::class, 'showLoginForm'])->name('peserta.loginForm');
    Route::post('/login/peserta', [AuthPesertaController::class, 'login'])->name('peserta.login');
});

//KONDISI ketika user sudah login
Route::middleware('auth:peserta')->group(function () {
    //dashboard peserta
    Route::get('/dashboard/peserta', [AuthPesertaController::class, 'dashboard'])->name('peserta.content_dashboard');
    Route::get('/events', [ProposalController::class, 'allEvents'])->name('peserta.all_event');

    Route::get('/event/detail', function () {
        return view('peserta.detail_event');
    })->name('peserta.detail_event');

    //log out peserta
    Route::get('/logout/peserta', [AuthPesertaController::class, 'logout'])
        ->name('peserta.logout');
    Route::get('/peserta/profile/{nim}', [PesertaController::class, 'show'])
        ->name('peserta.profile');
    Route::get('/pembayaran/konfirmasi/{nim}', [PembayaranTiketController::class, 'konfirmasi'])
        ->name('pembayaran.konfirmasi');
    Route::get('/pembayaran/form_bayar/{id}', [PembayaranTiketController::class, 'uploudForm'])
        ->name('pembayaran.bayar');
    Route::post('pembayaran/upload-form/{id_proposal}',action:[PembayaranTiketController::class,'store'])
        ->name('pembayaran.uploadForm.store');

    Route::get('/pembayaran/tiket/{id}', [PembayaranTiketController::class, 'tiket'])
        ->name('pembayaran.tiket');
    Route::get('/proposal/{id_proposal}/pembayaran', [PembayaranTiketController::class, 'index'])
            ->name('peserta.pembayaran.index');
    Route::post('/proposal/{id_proposal}/pembayaran', [PembayaranTiketController::class, 'store'])
        ->name('peserta.pembayaran.store');
    Route::get('/pembayaran/tiket/{id}/download', [PembayaranTiketController::class, 'downloadTiket'])
        ->name('pembayaran.download');
});


//middleware admin dan super panitia
Route::middleware(['auth.super'])->group(function () {
    Route::get('/halaman-verifikisi/{id}', [PembayaranTiketController::class, 'index'])->name('pembayaran.verifikasi');
    Route::put('/verifikasi-pembayaran/{id}', [PembayaranTiketController::class, 'updateStatus'])->name('verifikasi.pembayaran.update');
//rundown
    Route::post('/rundowns', [RundownController::class, 'store'])->name('rundowns.store');
    Route::get('/rundowns/{id}', [RundownController::class, 'show'])->name('rundowns.show');
    Route::get('/rundowns/{id}/edit', [RundownController::class, 'edit'])->name('rundowns.edit');
    Route::put('/rundowns/{id}', [RundownController::class, 'update'])->name('rundowns.update');
    Route::delete('/rundowns/{id}', [RundownController::class, 'destroy'])->name('rundowns.destroy');
//detail rundown
    Route::get('/rundowns/{id_rundown}/details/create', [DetailRundownController::class, 'create'])->name('detail-rundowns.create');
    Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
    Route::get('/detail-rundowns/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundowns.edit');
    Route::put('/detail-rundowns/{id}', [DetailRundownController::class, 'update'])->name('detail-rundowns.update');
    Route::delete('/detail-rundowns/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundowns.destroy');
    Route::get('/rundowns/{id}/export-pdf', [RundownController::class, 'exportPdf'])->name('rundowns.export.pdf');
    
    
//kuota
    Route::resource('kuota', KuotaPendaftaranController::class);
//peserta
    // Route::resource('peserta', PesertaController::class);
    Route::get('/proposals/{id_proposal}/peserta/created', [PesertaController::class, 'create'])->name('peserta.created');
    Route::post('/proposals/{id_proposal}/peserta', [PesertaController::class, 'store'])->name('peserta.store');
    Route::get('proposals/{id_proposal}/pesertas', [PesertaController::class, 'indexByProposal'])->name('peserta.byProposal');
    Route::get('/peserta/{nim}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{nim}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/peserta/{nim}', [PesertaController::class, 'update'])->name('peserta.destroy');
    // Rekap absensi panitia
    // Untuk halaman tampilan rekap
    Route::get('/rekap/rundown/{id_rundown}', [AbsensiPanitiaController::class, 'index'])
        ->name('rekap.rundown');
    // Untuk export PDF
    Route::get('/rekap/rundown/{id_rundown}/pdf', [AbsensiPanitiaController::class, 'exportPdf'])
        ->name('absensi.rekap.pdf');
    Route::get('/admin/proposal/{id_proposal}/pembayaran', [\App\Http\Controllers\PembayaranTiketController::class, 'index'])
        ->name('admin.pembayaran.index');
    Route::patch('/admin/pembayaran/{id}/status', [\App\Http\Controllers\PembayaranTiketController::class, 'updateStatus'])
        ->name('admin.pembayaran.updateStatus');
}); 






// // Admin management
// Route::resource('admins', AdminController::class);

// // Proposal management (semua)
// Route::resource('proposals', ProposalController::class);    

// // Persetujuan untuk semua proposal
// Route::resource('persetujuans', PersetujuanController::class);

// // Divisi hanya untuk admin
// Route::resource('divisis', DivisiController::class);

// Rundown semua proposal
// Route::get('/proposals/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])->name('rundowns.createRundown');
// Route::post('/rundowns', [RundownController::class, 'store'])->name('rundowns.store');
// Route::get('/rundowns/{id}', [RundownController::class, 'show'])->name('rundowns.show');
// Route::get('/rundowns/{id}/edit', [RundownController::class, 'edit'])->name('rundowns.edit');
// Route::put('/rundowns/{id}', [RundownController::class, 'update'])->name('rundowns.update');
// Route::delete('/rundowns/{id}', [RundownController::class, 'destroy'])->name('rundowns.destroy');

// Detail rundown semua
// Route::get('/rundowns/{id_rundown}/details/create', [DetailRundownController::class, 'create'])->name('detail-rundowns.create');
// Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
// Route::get('/detail-rundowns/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundowns.edit');
// Route::put('/detail-rundowns/{id}', [DetailRundownController::class, 'update'])->name('detail-rundowns.update');
// Route::delete('/detail-rundowns/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundowns.destroy');

// Kuota
// Route::resource('kuota', KuotaPendaftaranController::class);

// Semua peserta
//panitia(akademik)
// Route::get('persetujuans', [PersetujuanController::class, 'index'])->name('persetujuans.index');
// Route::get('persetujuans/{id_proposal}/edit', [PersetujuanController::class, 'edit'])->name('persetujuans.edit');
// Route::put('persetujuans/{id_proposal}', [PersetujuanController::class, 'update'])->name('persetujuans.update');

// Rundown (panitia acara)
// Route::get('/proposals/{id_proposal}/rundowns/create', [RundownController::class, 'createRundown'])->name('rundowns.createRundown');
// Route::post('/rundowns', [RundownController::class, 'store'])->name('rundowns.store');
// Route::get('/rundowns/{id}', [RundownController::class, 'show'])->name('rundowns.show');
// Route::get('/rundowns/{id}/edit', [RundownController::class, 'edit'])->name('rundowns.edit');
// Route::put('/rundowns/{id}', [RundownController::class, 'update'])->name('rundowns.update');
// Route::delete('/rundowns/{id}', [RundownController::class, 'destroy'])->name('rundowns.destroy');

// Detail rundown
// Route::get('/rundowns/{id_rundown}/details/create', [DetailRundownController::class, 'create'])->name('detail-rundowns.create');
// Route::post('/rundowns/{id_rundown}/detail-rundown', [DetailRundownController::class, 'store'])->name('detail-rundown.store');
// Route::get('/detail-rundowns/{id}/edit', [DetailRundownController::class, 'edit'])->name('detail-rundowns.edit');
// Route::put('/detail-rundowns/{id}', [DetailRundownController::class, 'update'])->name('detail-rundowns.update');
// Route::delete('/detail-rundowns/{id}', [DetailRundownController::class, 'destroy'])->name('detail-rundowns.destroy');


// Lihat semua peserta pada proposal (untuk proposal public atau terdaftar)

// Update data peserta (jika diizinkan)



