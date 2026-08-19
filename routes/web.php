<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebAuthController;
use App\Http\Controllers\Web\WebScholarshipController;
use App\Http\Controllers\Web\WebProfileController;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [WebAuthController::class, 'login']);
    
    Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [WebAuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
    
    // Profile
    Route::get('/profile', [WebProfileController::class, 'show'])->name('web.profile.show');
    Route::put('/profile', [WebProfileController::class, 'update'])->name('web.profile.update');
    
    // Scholarships (Read-only for users, CRUD for admin)
    Route::get('/scholarships', [WebScholarshipController::class, 'index'])->name('web.scholarships.index');
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/scholarships/create', [WebScholarshipController::class, 'create'])->name('web.scholarships.create');
        Route::post('/scholarships', [WebScholarshipController::class, 'store'])->name('web.scholarships.store');
        Route::get('/scholarships/{scholarship}/edit', [WebScholarshipController::class, 'edit'])->name('web.scholarships.edit');
        Route::put('/scholarships/{scholarship}', [WebScholarshipController::class, 'update'])->name('web.scholarships.update');
        Route::delete('/scholarships/{scholarship}', [WebScholarshipController::class, 'destroy'])->name('web.scholarships.destroy');
    });
});
