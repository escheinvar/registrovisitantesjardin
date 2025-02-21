<?php

use App\Http\Controllers\login\loginController;
use App\Http\Controllers\login\logoutController;
use App\Livewire\BoletosComponent;
use App\Livewire\GruposComponent;
use App\Livewire\HomeComponent;
use App\Livewire\UsersComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\soloAdminMiddle;
use App\Http\Middleware\soloRecorridosMiddle;
use App\Livewire\VerRecorridosComponent;

Route::middleware(['auth.basic'])->group(function(){
    Route::get('/home',HomeComponent::class)->name('home');
    Route::get('/grupos',GruposComponent::class)->name('grupos')->middleware(soloRecorridosMiddle::class);;
    Route::get('/boletos',BoletosComponent::class)->name('boletos')->middleware(soloRecorridosMiddle::class);;
    Route::get('/usuarios',UsersComponent::class)->name('usuarios')->middleware(soloAdminMiddle::class);
    Route::get('/verRecorridos',VerRecorridosComponent::class)->name('verRecs');
});



/* ---------------------------------------- LOGIN / LOGOUT ------------------------- */
Route::get('/',[loginController::class,'index'])->name('login');
Route::post('/',[loginController::class,'store']);
Route::post('/logout',[logoutController::class,'store'])->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// });
