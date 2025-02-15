<?php

use App\Livewire\BoletosComponent;
use App\Livewire\GruposComponent;
use App\Models\gruposModel;
use Illuminate\Support\Facades\Route;


Route::get('/grupos',GruposComponent::class)->name('grupos');
Route::get('/boletos',BoletosComponent::class)->name('boletos');
// Route::get('/', function () {
//     return view('welcome');
// });
