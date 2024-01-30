<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')->group(function(){

    Route::get('login',[AdminController::class, 'index'])->name('admin_login_form');
    Route::post('login/owner',[AdminController::class, 'login'])->name('admin.login');
    
    Route::post('logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');


});
Route::prefix('editor')->group(function(){

    Route::get('login',[EditorController::class, 'index'])->name('editor_login_form');
    Route::post('editor/owner',[EditorController::class, 'login'])->name('editor.login');
    Route::get('dashboard',[EditorController::class, 'dashboard'])->name('editor.dashboard')->middleware('editor');


});


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
});

require __DIR__.'/auth.php';
