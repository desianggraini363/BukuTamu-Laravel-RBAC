<?php

use Illuminate\Support\Facades\Route;

// Mengalihkan halaman utama langsung ke link login Filament
Route::get('/', function () {
    return redirect()->to('/admin');
});