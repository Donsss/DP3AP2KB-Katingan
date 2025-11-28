<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\TugasController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\PegawaiPageController;
use App\Http\Controllers\TugasFungsiController;
// use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\VisiMisiPageController;
// use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\QuickLinkController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProfilPimpinanController;
use App\Http\Controllers\Admin\StrukturBidangController;
use App\Http\Controllers\Admin\StrukturAnggotaController;
use App\Http\Controllers\Admin\RiwayatPekerjaanController;
use App\Http\Controllers\Admin\RiwayatPendidikanController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/berita', [PostController::class, 'index'])->name('berita.index');
Route::get('/berita/{post}', [PostController::class, 'show'])->name('berita.show');

Route::get('/kontak', [ContactController::class, 'create'])->name('kontak');

Route::post('/kontak', [ContactController::class, 'store'])
    ->name('kontak.store')
    ->middleware('throttle:3,1');

Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen.index');
Route::get('/dokumen/{document}/show', [DocumentController::class, 'show'])->name('dokumen.show');
Route::get('/dokumen/{document}/download', [DocumentController::class, 'download'])->name('dokumen.download');

Route::get('/foto', [GalleryController::class, 'photos'])->name('foto');
Route::get('/video', [GalleryController::class, 'videos'])->name('video'); 

Route::get('/tugas', [TugasFungsiController::class, 'show'])->name('tugas');

Route::get('/data-pegawai', function () {
    return view('user-views.data-pegawai');
})->name('data-pegawai');

Route::get('/struktur-pegawai', [PegawaiPageController::class, 'index'])->name('pegawai.index');

Route::get('/kadis', function () {
    return view('user-views.kadis');
})->name('kadis');

Route::get('/visi-misi', [VisiMisiPageController::class, 'index'])->name('visi-misi');

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi');

Route::get('/profil-pimpinan', [ProfilController::class, 'index'])->name('profil.pimpinan');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::get('/api/agendas', [AgendaController::class, 'getEvents']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('sliders/update-order', [SliderController::class, 'updateOrder'])->name('sliders.updateOrder');
    Route::resource('sliders', SliderController::class);

    Route::resource('photos', PhotoController::class);

    Route::resource('videos', VideoController::class);
    Route::post('videos/fetch-youtube-info', [VideoController::class, 'fetchYoutubeInfo'])->name('videos.fetchYoutubeInfo');

    Route::resource('documents', AdminDocumentController::class);

    Route::resource('posts', AdminPostController::class);

    Route::resource('admin/agenda', AdminAgendaController::class)->names('admin.agenda');

    // Route::resource('bidang', BidangController::class)->except(['show']);
    // Route::resource('admin/pegawai', PegawaiController::class)->names('admin.pegawai');
    // Route::post('admin/pegawai/update-order', [PegawaiController::class, 'updateOrder'])->name('admin.pegawai.updateOrder');

    Route::get('admin/profil-pimpinan/edit', [ProfilPimpinanController::class, 'edit'])->name('admin.pimpinan.edit');
    Route::put('admin/profil-pimpinan/update', [ProfilPimpinanController::class, 'update'])->name('admin.pimpinan.update');

    Route::resource('riwayat-pendidikan', RiwayatPendidikanController::class)
         ->except(['show'])
         ->names('admin.pendidikan');

    Route::resource('riwayat-pekerjaan', RiwayatPekerjaanController::class)
         ->except(['show'])
         ->names('admin.pekerjaan');
    
    Route::get('pengaturan-website', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('pengaturan-website', [SettingController::class, 'update'])->name('admin.settings.update');

    Route::resource('quick-links', QuickLinkController::class)->except(['show']);
    Route::post('quick-links/update-order', [QuickLinkController::class, 'updateOrder'])->name('quick-links.updateOrder');

    Route::get('admin/visi-misi', [VisiMisiController::class, 'edit'])->name('admin.visimisi.edit');
    Route::put('admin/visi-misi', [VisiMisiController::class, 'update'])->name('admin.visimisi.update');

    Route::middleware('can:manage users')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::middleware('can:manage users')->prefix('admin')->name('admin.')->group(function () {
        Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
        Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore')->withTrashed();
        Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete')->withTrashed();
    });

    Route::get('/tugas-fungsi', [TugasController::class, 'edit'])->name('admin.tugas.edit');
    Route::post('/tugas-fungsi', [TugasController::class, 'update'])->name('admin.tugas.update');
    Route::delete('/tugas-fungsi', [TugasController::class, 'destroy'])->name('admin.tugas.destroy');

    Route::post('struktur-bidang/update-order', [StrukturBidangController::class, 'updateOrder'])->name('admin.struktur-bidang.updateOrder');
    Route::resource('struktur-bidang', StrukturBidangController::class, ['names' => 'admin.struktur-bidang']);

    Route::post('struktur-anggota/update-order', [StrukturAnggotaController::class, 'updateOrder'])->name('admin.struktur-anggota.updateOrder');
    Route::resource('struktur-anggota', StrukturAnggotaController::class, ['names' => 'admin.struktur-anggota']);
    Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/{message}', [ContactMessageController::class, 'show'])->name('show');
        Route::delete('/{message}', [ContactMessageController::class, 'destroy'])->name('destroy');
    });

    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log.index');
    Route::delete('/activity-log/{id}', [ActivityLogController::class, 'destroy'])->name('admin.activity-log.destroy');
});

Route::fallback(function () {
    return redirect()->to('/'); 
});

require __DIR__.'/auth.php';
