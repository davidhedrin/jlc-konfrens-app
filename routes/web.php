<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\LoginComponent;
use App\Http\Livewire\LogoutComponent;
use App\Http\Livewire\RegisterComponent;
use App\Http\Livewire\UserManagementComponent;
use App\Http\Livewire\JemaatComponent;
use App\Http\Livewire\JabatanComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', LogoutComponent::class)->name('logout');

//For All
Route::middleware('guest')->group(function(){
    Route::get('/login', LoginComponent::class)->name('login');
    Route::get('/register', RegisterComponent::class)->name('register');
});

//For User
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/', HomeComponent::class)->name('index');
});

//For Admin
Route::middleware(['auth:sanctum', 'verified', 'authrole'])->group(function(){
    Route::get('/all-users', UserManagementComponent::class)->name('all.users');
    Route::get('/all-jemaats', JemaatComponent::class)->name('all.jemaats');
    Route::get('/all-jabatan', JabatanComponent::class)->name('all.jabatan');
});

// Route::get('/', function () {
//     return view('welcome');
// });
