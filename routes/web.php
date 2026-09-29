<?php

use Illuminate\Support\Facades\Route;

// Tahap 1: halaman test. Akan diganti homepage di Tahap 8/9.
Route::view('/', 'test')->name('home');
