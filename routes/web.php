<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController; // Add this import
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| Define web routes for the application. 
*/

// Public Routes
Route::get('/', function () {
    return redirect()->route('staff.login'); // Redirect to the staff login page
});

// Registration Routes for Staff
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Show registration form
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register'); // Handle form submission

// Staff Login Routes
Route::get('staff/login', [LoginController::class, 'showLoginForm'])->name('staff.login');
Route::post('staff/login', [LoginController::class, 'login']);

// Dashboard Routes (Requires Authentication)
Route::middleware(['auth', 'verified'])->group(function () {
    // Single dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Include Authentication Routes
require __DIR__.'/auth.php';
