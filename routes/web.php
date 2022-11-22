<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/students', [StudentController::class, 'index'])->name('student.index')->middleware('auth');
Route::post('/students', [StudentController::class, 'store'])->name('student.store')->middleware('auth');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create')->middleware('auth');
Route::get('/student/{student_id}/edit', [StudentController::class, 'edit'])->name('student.edit')->middleware('auth');
Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update')->middleware('auth');
Route::delete('/student/{student_id}', [StudentController::class, 'destroy'])->name('student.destroy')->middleware('auth');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
