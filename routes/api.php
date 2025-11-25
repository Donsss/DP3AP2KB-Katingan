<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AgendaController;
use App\Http\Controllers\API\ContactMessageController;
use App\Http\Controllers\API\DocumentController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\ProfilPimpinanController;
use App\Http\Controllers\API\QuickLinkController;
use App\Http\Controllers\API\RiwayatPekerjaanController;
use App\Http\Controllers\API\RiwayatPendidikanController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\StrukturBidangController;
use App\Http\Controllers\API\StrukturAnggotaController;
use App\Http\Controllers\API\TugasController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\VisiMisiController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::apiResource('agendas', AgendaController::class);
    Route::apiResource('messages', ContactMessageController::class)->except(['store', 'update']); // Read/Delete only
    Route::apiResource('documents', DocumentController::class);
    Route::apiResource('photos', PhotoController::class);

    Route::get('pimpinan', [ProfilPimpinanController::class, 'index']);
    Route::post('pimpinan', [ProfilPimpinanController::class, 'update']); // Menggunakan POST + _method=PUT

    Route::post('quick-links/reorder', [QuickLinkController::class, 'updateOrder']);
    Route::apiResource('quick-links', QuickLinkController::class);

    Route::apiResource('pekerjaan', RiwayatPekerjaanController::class);

    Route::apiResource('pendidikan', RiwayatPendidikanController::class);

    Route::get('settings', [SettingController::class, 'index']);
    Route::post('settings', [SettingController::class, 'update']);

    Route::post('struktur-bidang/reorder', [StrukturBidangController::class, 'updateOrder']);
    Route::apiResource('struktur-bidang', StrukturBidangController::class);
    
    Route::post('struktur-anggota/reorder', [StrukturAnggotaController::class, 'updateOrder']);
    Route::apiResource('struktur-anggota', StrukturAnggotaController::class);

    Route::get('tugas', [TugasController::class, 'edit']); // Get info
    Route::put('tugas', [TugasController::class, 'update']); // Update file
    Route::delete('tugas', [TugasController::class, 'destroy']); // Delete file

    Route::get('users/trash', [UserController::class, 'trash']);
    Route::post('users/{id}/restore', [UserController::class, 'restore']);
    Route::delete('users/{id}/force', [UserController::class, 'forceDelete']);
    Route::apiResource('users', UserController::class);

    Route::post('videos/fetch-info', [VideoController::class, 'fetchYoutubeInfo']);
    Route::apiResource('videos', VideoController::class);

    Route::get('visimisi', [VisiMisiController::class, 'index']);
    Route::put('visimisi', [VisiMisiController::class, 'update']);
});