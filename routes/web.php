<?php

use App\Http\Controllers\login\loginController;
use App\Http\Controllers\login\logoutController;
use App\Livewire\BoletosComponent;
use App\Livewire\GruposComponent;
use App\Livewire\HomeComponent;
use App\Livewire\UsersComponent;
use App\Models\gruposModel;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth.basic'])->group(function(){
    Route::get('/grupos',GruposComponent::class)->name('grupos');
    Route::get('/boletos',BoletosComponent::class)->name('boletos');
    Route::get('/home',HomeComponent::class)->name('home');
    Route::get('/usuarios',UsersComponent::class)->name('usuarios');
});

/* ---------------------------------------- LOGIN / LOGOUT ------------------------- */
Route::get('/',[loginController::class,'index'])->name('login');
Route::post('/',[loginController::class,'store']);
Route::post('/logout',[logoutController::class,'store'])->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// });
