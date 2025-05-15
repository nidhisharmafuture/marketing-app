<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminModule\Http\Controllers\admin\AdminModuleController;
use Modules\AdminModule\Http\Controllers\admin\DesignerFileController;
use Modules\AdminModule\Http\Controllers\admin\CategoryController;
use Modules\AdminModule\Http\Controllers\admin\MediaController;



use Modules\AdminModule\Http\Controllers\designer\DesignerModuleController;
use Modules\AdminModule\Http\Controllers\AuthModuleController;

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

// Route::prefix('adminmodule')->group(function() {
//     Route::get('/', 'AdminModuleController@index');
// });

Route::get('/admin-login', [AdminModuleController::class, 'adminLoginPage'])->name('admin.loginPage')->middleware('CheckAdminAuth');

Route::get('/designer-login', [DesignerModuleController::class, 'designerLoginPage'])->name('designer.loginPage')->middleware('CheckDesignerAuth');





Route::prefix('admin')->group(function () {
  Route::post("login/process", [AdminModuleController::class, 'loginProcess'])->name('admin.login-process');
  Route::get("logout/process", [AdminModuleController::class, 'logout'])->name('admin.logout-process');
  Route::group(['middleware' => ['CheckAdminLogin']], function () {

    Route::get('/dashboard', [AdminModuleController::class, 'dashboardPage'])->name('admin.dashboard');
    Route::get('/profile/page', [AdminModuleController::class, 'profilePage'])->name('admin.profile.page');
    Route::post('/update-profile', [AdminModuleController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/change-password', [AdminModuleController::class, 'changePassword'])->name('admin.profile.changepassword');
  
  // create designer

        Route::get('/designer-listing', [DesignerFileController::class, 'designerList'])->name('admin.designer.list');
 Route::get('/designer/create', [DesignerFileController::class, 'designerCreate'])->name('admin.designer.create');
    Route::post('/designer/store', [DesignerFileController::class, 'designerStore'])->name('admin.designer.store');
    Route::get('/designer/edit/{id}', [DesignerFileController::class, 'designerEdit'])->name('admin.designer.edit');
    Route::put('/designer/update/{id}', [DesignerFileController::class, 'designerUpdate'])->name('admin.designer.update');
    Route::delete('/designer/delete/{id}', [DesignerFileController::class, 'designerDestroy'])->name('admin.designer.destroy');
  Route::get('/designer/show/{id}', [DesignerFileController::class, 'designerShow'])->name('admin.designer.show');

  // category designer

        Route::get('/category-listing', [CategoryController::class, 'categoryList'])->name('admin.category.list');
 Route::get('/category/create', [CategoryController::class, 'categoryCreate'])->name('admin.category.create');
    Route::post('/category/store', [CategoryController::class, 'categoryStore'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin.category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('admin.category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'categoryDestroy'])->name('admin.category.destroy');
  Route::get('/category/show/{id}', [CategoryController::class, 'categoryShow'])->name('admin.category.show');
  

    // Media designer

        Route::get('/media-listing', [MediaController::class, 'mediaList'])->name('admin.media.list');
 Route::get('/media/create', [MediaController::class, 'mediaCreate'])->name('admin.media.create');
    Route::post('/media/store', [MediaController::class, 'mediaStore'])->name('admin.media.store');
    Route::get('/media/edit/{id}', [MediaController::class, 'mediaEdit'])->name('admin.media.edit');
    Route::put('/media/update/{id}', [MediaController::class, 'mediaUpdate'])->name('admin.media.update');
    Route::delete('/media/delete/{id}', [MediaController::class, 'mediaDestroy'])->name('admin.media.destroy');
  Route::get('/media/show/{id}', [MediaController::class, 'mediaShow'])->name('admin.media.show');
  
  });
});


Route::prefix('designer')->group(function () {
  Route::post("login/process", [DesignerModuleController::class, 'loginProcess'])->name('designer.login-process');
  Route::get("logout/process", [DesignerModuleController::class, 'logout'])->name('designer.logout-process');
  Route::group(['middleware' => ['CheckDesignerLogin']], function () {
    Route::get('/dashboard', [DesignerModuleController::class, 'dashboardPage'])->name('designer.dashboard');
    Route::get('/profile/page', [DesignerModuleController::class, 'profilePage'])->name('designer.profile.page');

    Route::post('update-profile', [DesignerModuleController::class, 'updateProfile'])->name('designer.profile.update');
    Route::post('change-password', [DesignerModuleController::class, 'changePassword'])->name('designer.profile.changepassword');
  

  
  
  
  });
});
