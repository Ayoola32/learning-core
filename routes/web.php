<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\FrontendCoursePages;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\InstructorProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\StudentProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/courses', [FrontendCoursePages::class, 'index'])->name('courses');
Route::get('/course/{slug}', [FrontendCoursePages::class, 'show'])->name('course.details');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{course}', [CartController::class, 'addToCart'])->name('cart.add');

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

    // Course Management
    Route::resource('/courses', CourseController::class);
    Route::get('/course-content/{course}/create-chapter', [CourseContentController::class, 'createChapter'])->name('course-content.create-chapter');
    Route::post('/course-content/{course}/store-chapter', [CourseContentController::class, 'storeChapter'])->name('course-content.store-chapter');
    Route::get('/course-content/{course}/edit-chapter/{chapter}', [CourseContentController::class, 'editChapter'])->name('course-content.edit-chapter');
    Route::put('/course-content/{course}/update-chapter/{chapter}', [CourseContentController::class, 'updateChapter'])->name('course-content.update-chapter');
    Route::delete('/course-content/{course}/delete-chapter/{chapter}', [CourseContentController::class, 'deleteChapter'])->name('course-content.delete-chapter');
    
    Route::get('/course-content/{course}/create-lesson/{chapter}', [CourseContentController::class, 'createLesson'])->name('course-content.create-lesson');
    Route::post('/course-content/{course}/store-lesson/{chapter}', [CourseContentController::class, 'storeLesson'])->name('course-content.store-lesson');
    Route::get('/course-content/{course}/edit-lesson/{chapter}/{lesson}', [CourseContentController::class, 'editLesson'])->name('course-content.edit-lesson');
    Route::put('/course-content/{course}/update-lesson/{chapter}/{lesson}', [CourseContentController::class, 'updateLesson'])->name('course-content.update-lesson');
    Route::delete('/course-content/{course}/delete-lesson/{chapter}/{lesson}', [CourseContentController::class, 'deleteLesson'])->name('course-content.delete-lesson');

    Route::post('/course-content/chapter/{chapter}/update-lesson-order', [CourseContentController::class, 'updateLessonOrder'])->name('course-content.update-lesson-order');
    Route::get('/course-content/{course}/sort-chapters', [CourseContentController::class, 'showSortChapters'])->name('course-content.sort-chapters');
    Route::post('/course-content/{course}/update-chapter-order', [CourseContentController::class, 'updateChapterOrder'])->name('course-content.update-chapter-order');

    //Laravel File Manager Route
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
