<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin', [FileUploadController::class, 'index'])->name('admin');
    Route::post('/admin/upload', [FileUploadController::class, 'upload'])->name('upload.file');
    Route::get('/admin/download/{name}', [FileUploadController::class, 'downloadFiltered'])->name('admin.filtered.download');
});

require __DIR__.'/auth.php';
