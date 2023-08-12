<?php

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

// Роутер с применением middleware "auth"
Route::middleware('auth')->get('/protected', function () {
    return 'Здравствуйте';
});

Route::middleware('guest')->get('/protected', function () {
    return 'Привет';
});

Route::get('/', function () {
    $user = auth()->user(); // Получаем текущего аутентифицированного пользователя
    $username = $user ? $user->name : 'гость'; // Если пользователь аутентифицирован, получаем его имя, иначе - 'гость'
    return view('main', ['username' => $username]);
});

// routes/web.php
Route::get('/popup', function () {
    return view('popup');
});

///
use App\Http\Controllers\TestController;

Route::get('/dashboard/{id}', [TestController::class, 'show'])->name('viewtest');


Route::get('/main', function () {
    return view('main');
});


Route::get('/dashboard', [TestController::class, 'index'])->name('dashboard');

Route::get('/dashboard/{id}', [TestController::class, 'getQuestionsForTest'])->name('dashboardid');

Route::post('/dashboard/{id}', [TestController::class, 'saveResult'])->name('test.save-result');

Route::get('/mytests', [TestController::class, 'index2'])->name('test.mytests');

//CRUD
Route::get('/test/create', [TestController::class, 'create'])->name('test.create');
Route::post('/test', [TestController::class, 'store'])->name('test.store');
Route::get('/test', [TestController::class, 'index'])->name('test.index');
Route::get('/test/{id}/edit', [TestController::class, 'edit'])->name('test.edit');
Route::put('/test/{id}', [TestController::class, 'update'])->name('test.update');
Route::delete('/test/{id}', [TestController::class, 'destroy'])->name('test.destroy');