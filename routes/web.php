<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

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

// Post Routes
Route::resource('posts', PostController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->names('posts'); // Ensure PostController exists and is correctly imported

// Authenticated routes for Posts, Categories, and Tags
Route::middleware(['auth'])->group(function () {

    
    // Category Routes
    Route::resource('categories', CategoryController::class)->names('categories');

    // Tag Routes
    Route::resource('tags', TagController::class)->names('tags');

    // Roles Routes - Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('roles', RoleController::class)->names('roles');
    });

    // Permissions Routes - Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('permissions', PermissionController::class)->names('permissions');
    });
});

require __DIR__.'/auth.php';
