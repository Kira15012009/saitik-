<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/', [TextController::class, 'index'])->name('home');
Route::get('/category/{slug?}', [TextController::class, 'category'])->name('category');


Route::middleware(['auth', 'role:journalist,admin'])->group(function () {
    Route::get('/articles/create', [TextController::class, 'create'])->name('journalist');
    Route::post('/articles', [TextController::class, 'store'])->name('texts.store');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/articles/{id}/edit', [AdminController::class, 'edit'])->name('admin.articles.edit');
    Route::post('/admin/articles/{id}', [AdminController::class, 'update'])->name('admin.articles.update');
    Route::post('/admin/articles/{id}/toggle', [AdminController::class, 'togglePublish'])->name('admin.articles.toggle');
    Route::post('/admin/articles/{id}/delete', [AdminController::class, 'destroy'])->name('admin.articles.delete');

    
    Route::post('/admin/users/{id}/role', [AdminController::class, 'updateRole'])->name('admin.users.role');
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');