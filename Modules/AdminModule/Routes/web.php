<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminModule\Http\Controllers\admin\AdminModuleController;
use Modules\AdminModule\Http\Controllers\admin\DesignerFileController;

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
