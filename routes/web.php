<?php

use App\Http\Controllers\DepotArgentController;
use App\Http\Controllers\EnvoiArgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
// Route::get('/home', [HomeController::class, 'profil'])->middleware('auth')->name('profil');

Route::get('post',[HomeController::class,'post'])->middleware(['auth','admin'])->name('post');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/post/bloquer/{user}', [HomeController::class, 'bloquer'])->name('admin.bloquer');
    Route::post('/post/debloquer/{user}', [HomeController::class, 'debloquer'])->name('admin.debloquer');
});




// Route::get('guichet/guichetpage',[HomeController::class,'guichetpage'])->middleware(['auth','guichet'])->name('guichetpage');
Route::get('/guichet/guichetpage',[HomeController::class, 'showEnvoyerArgentForm'])->name('depot');
Route::post('/guichet/guichetpage', [DepotArgentController::class, 'depot']);
//Route::get('/home', [HomeController::class, 'showTransactions'])->middleware(['auth','guichet'])->name('transactions');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/envoyer-argent',[HomeController::class, 'showEnvoyerArgentForm'])->name('envoyer_argent');
    Route::post('/envoyer-argent', [EnvoiArgentController::class, 'envoyerArgent']);
    Route::get('/transactions', [HomeController::class, 'showTransactions'])->name('transactions');
});

require __DIR__.'/auth.php';
