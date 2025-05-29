<?php

use App\Livewire\Home;
use App\Livewire\IndexAduan;
use App\Livewire\CreateAduan;
use App\Livewire\ShowAduan;
use App\Livewire\AlurPengaduan;
use Illuminate\Support\Facades\Route;



 
Route::get('/', Home::class)->name('home');

Route::get('/aduan', IndexAduan::class)->name('aduans.index');

Route::get('/aduan/buat', CreateAduan::class)->name('aduans.create');

Route::get('/aduan/{slug}', ShowAduan::class)->name('aduans.show');

Route::get('/alur-pengaduan', AlurPengaduan::class)->name('alur');

