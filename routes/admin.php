<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/our-work', [DashboardController::class, 'ourWorkShow'])->name('dashboard.our-work.show');
        Route::get('/dashboard/our-work/create', [DashboardController::class, 'ourWorkCreate'])->name('dashboard.our-work.create');
        Route::post('/dashboard/our-work', [DashboardController::class, 'updateOurWork'])->name('dashboard.our-work.update');
        Route::delete('/dashboard/our-work/images/{image}', [DashboardController::class, 'deleteOurWorkImage'])->name('dashboard.our-work.images.destroy');

        // Separate video/image pages
        Route::get('/dashboard/our-work/videos', [DashboardController::class, 'ourWorkVideosShow'])->name('dashboard.our-work.videos.show');
        Route::get('/dashboard/our-work/videos/create', [DashboardController::class, 'ourWorkVideosCreate'])->name('dashboard.our-work.videos.create');
        Route::get('/dashboard/our-work/videos/{video}/edit', [DashboardController::class, 'ourWorkVideosEdit'])->name('dashboard.our-work.videos.edit');
        Route::match(['put', 'patch'], '/dashboard/our-work/videos/{video}', [DashboardController::class, 'updateOurWorkVideo'])->name('dashboard.our-work.videos.update');
        Route::delete('/dashboard/our-work/videos/{video}', [DashboardController::class, 'deleteOurWorkVideo'])->name('dashboard.our-work.videos.destroy');

        Route::get('/dashboard/our-work/images', [DashboardController::class, 'ourWorkImagesShow'])->name('dashboard.our-work.images.show');
        Route::get('/dashboard/our-work/images/create', [DashboardController::class, 'ourWorkImagesCreate'])->name('dashboard.our-work.images.create');
        Route::get('/dashboard/our-work/images/{image}/edit', [DashboardController::class, 'ourWorkImagesEdit'])->name('dashboard.our-work.images.edit');
        Route::match(['put', 'patch'], '/dashboard/our-work/images/{image}', [DashboardController::class, 'updateOurWorkImage'])->name('dashboard.our-work.images.update');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('posts', PostController::class)->except(['show']);
        Route::resource('pages', PageController::class)->except(['show']);
    });

});
