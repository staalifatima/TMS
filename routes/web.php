<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>['auth']], function () {
    
    Route::get('client', [ClientController::class,'index'])->name('client');
    Route::get('partner', [PartnerController::class,'index'])->name('partner');
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    
});




//for client
Route::group(['middleware'=>['auth', 'role:client']], function () {
    Route::get('client/myprofile', [ClientController::class,'myprofile'])->name('dashboard.myprofile');
    Route::get('client/clientupdate', [ClientController::class,'update'])->name('profile.clientupdate');
});
//for partner
Route::group(['middleware'=>['auth', 'role:partner']], function () {
    Route::get('partner/partnerprofile', [PartnerController::class,'myprofile'])->name('dashboard.partnerprofile');
    Route::get('partner/partnerupdate', [PartnerController::class,'update'])->name('profile.partnerupdate');
});
//for admin
Route::group(['middleware'=>['auth', 'role:admin']], function () {
    Route::get('admin/list', [PartnerController::class,'show'])->name('dashboard.list');
    Route::get('admin/clientlist', [ClientController::class,'show'])->name('dashboard.clientlist');
    Route::get('admin/userslist', [UserController::class,'show'])->name('dashboard.userslist');
    Route::delete('admin/userslist/{id?}', [UserController::class,'destroy'])->name('userslist.delete');

});

require __DIR__.'/auth.php';