<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store']);
Route::get('login', [AuthenticatedUserController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedUserController::class, 'store']);


Route::middleware(['Auth','Active'])->group(function () {
   
Route::prefix('school-classes')->group(function () {
    Route::get('/', [SchoolClassController::class, 'index'])->name('school-classes.index');
    Route::get('/create', [SchoolClassController::class, 'create'])->name('school-classes.create');
    Route::post('/', [SchoolClassController::class, 'store'])->name('school-classes.store');
    Route::get('/{id}', [SchoolClassController::class, 'show'])->name('school-classes.show');
    Route::get('/{id}/edit', [SchoolClassController::class, 'edit'])->name('school-classes.edit');
    Route::put('/{id}', [SchoolClassController::class, 'update'])->name('school-classes.update');
    Route::delete('/{id}', [SchoolClassController::class, 'destroy'])->name('school-classes.destroy');
});

Route::prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/{id}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/{id}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
});

Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/', [StudentController::class, 'store'])->name('students.store');
    Route::get('/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
});

});