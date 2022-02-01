<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Engineer\DashboardMonitoring;

//login halaman utama dan authentiksi
Route::get('/',[Login::class, 'index'])->name('login')->middleware('guest');
Route::post('/',[Login::class, 'store']);

//akses ke dashboard masing masing, user, admin, engineer
Route::group(['middleware' => ['auth', 'CheckRules:user,admin,engineer']], function(){

    Route::get('/dashboard',[Dashboard::class, 'index']); //going to dashboard

});

//Middleware => user : untuk user akses kedalam dashboard.
Route::group(['middleware' => ['auth', 'CheckRules:user']], function(){

        Route::post('/dashboard',[Dashboard::class, 'store']); //token store update

});

// Middleware => engineer : untuk monitoring oleh engineer dan check list alat selesai atau belum
Route::group(['middleware' => ['auth', 'CheckRules:engineer']], function(){

    Route::get('/dashboard/verify/{id}',[DashboardMonitoring::class, 'edit']);

});

// Middleware => user,engineer : hanya mengijinkan user dan engineer untuk update profile
Route::group(['middleware' => ['auth', 'CheckRules:engineer,user']], function(){

    Route::get('/dashboard/profile/{id}',[Dashboard::class, 'edit']);
    Route::post('/dashboard/profile/{id}',[Dashboard::class, 'update']);

});

//router admin untuk registrasi user dan engineer
Route::group(['middleware' => ['auth', 'CheckRules:admin']], function(){

    Route::get('/dashboard/register/user',[Register::class, 'index']);
    Route::post('/dashboard/register/user',[Register::class, 'store']);
    Route::get('/dashboard/user/delete/{id}',[Dashboard::class, 'destroy']);

});

// logout semua rules => user, admin, dan engineer
Route::post('/logout',[Logout::class, 'logout']);
