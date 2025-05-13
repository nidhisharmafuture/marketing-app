<?php
use Illuminate\Support\Facades\Route;
use Modules\AdminModule\Http\Controllers\AdminModuleController;
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

Route::prefix('admin')->group(function () {
    Route::post("login/process", [AdminModuleController::class, 'loginProcess'])->name('admin.login-process');
    Route::get("logout/process", [AdminModuleController::class, 'logout'])->name('admin.logout-process');
    Route::group(['middleware'=>['CheckAdminLogin']],function(){

       Route::get('/dashboard', [AdminModuleController::class, 'dashboardPage'])->name('admin.dashboard');

    });

   
});
