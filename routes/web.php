<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\InstructorProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\StudentProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');

// Student Route
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor');
    Route::post('/become-instructor/{user}', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become-instructor.update');

    // Profile Controller
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-update', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [StudentProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/profile/update-social-links', [StudentProfileController::class, 'updateSocialLinks'])->name('profile.update-social-links');
});

// Instructor Route
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');

    // Profile Controller
    Route::get('/profile', [InstructorProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-update', [InstructorProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [InstructorProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/profile/update-social-links', [InstructorProfileController::class, 'updateSocialLinks'])->name('profile.update-social-links');
    
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
