<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplexController;
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

Route::get('/complexs',[ComplexController::class,'index'])->name('complex.index');
Route::get('/complexs/{complex}',[ComplexController::class,'show'])->name('complex.show');
Route::get('/complex/create',[ComplexController::class,'create'])->name('complex.create');
Route::post('/complex/store', [ComplexController::class, 'store'])->name('complex.store');
Route::delete('complexs/{complex}', [ComplexController::class, 'destroy'])->name('complex.destroy');
require __DIR__.'/auth.php';
