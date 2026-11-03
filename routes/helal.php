<?php
/**
 * Backend Admin Routes for Web Application
 *
 * This file contains all the routes for managing the admin panel, including routes for
 * dashboard, system Settings, profile Settings, daily tips, blogs, and natural care.
 * Routes are grouped under the 'admin' prefix and require authentication with the 'admin' middleware.
 */



use App\Http\Controllers\Web\Backend\ContentCMSController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\Settings\DynamicPageController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingController;
use App\Http\Controllers\Web\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('setting-system', function () {
        return view('backend.layout.setting.system');
    })->name('setting.system.index');

    Route::get('setting-system', [SystemSettingController::class, 'index'])->name('setting.system.index');
    Route::post('setting-update', [SystemSettingController::class, 'update'])->name('setting.system.update');
    Route::get('setting-configuration', [SystemSettingController::class, 'configuration'])->name('setting.configuration.index');

    // Mail Settings
    Route::post('setting-configuration-mail', [SystemSettingController::class, 'mailSettingUpdate'])->name('setting.configuration.mail');

    // Social App Settings
    Route::post('setting-configuration-social', [SystemSettingController::class, 'socialAppUpdate'])->name('setting.configuration.social');
    
    // ProfileController
    Route::get('setting-profile', [ProfileController::class, 'index'])->name('setting.profile.index');
    Route::post('setting-profile', [ProfileController::class, 'update'])->name('setting.profile.update');
    Route::post('setting-profile-password', [ProfileController::class, 'UpdatePassword'])->name('setting.profile.password');

    //!Route for DynamicPageController
    Route::resource('/dynamic-page', DynamicPageController::class);
    Route::post('/dynamic-page/status/{id}', [DynamicPageController::class, 'status'])->name('dynamic.page.status');

    //!Route for UserController
    Route::resource('/users', UserController::class);
    Route::post('/users/status/{id}', [UserController::class, 'status'])->name('users.status');

    //!Route for ContentCMSController
    Route::resource('/contents', ContentCMSController::class);
    Route::post('/contents/status/{id}', [ContentCMSController::class, 'status'])->name('contents.status');
});

//  all user can entry this page
Route::get('/pages/{slug}', [DynamicPageController::class, 'showDaynamicPage'])->name('pages');
