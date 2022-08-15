<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\Engineer\AlatEngineer;
use App\Http\Controllers\Admin\RegistrerEngineer;

//login halaman utama dan authentiksi
Route::get('/',[Login::class, 'index'])->name('login')->middleware('guest');
Route::post('/',[Login::class, 'store']);

//akses ke dashboard masing masing, user, admin, engineer
Route::group(['middleware' => ['auth', 'CheckRules:user,admin,engineer']], function(){

    Route::get('/dashboard',[Dashboard::class, 'index']); //going to dashboard
    Route::get('/dashboard/profile/{id}',[Dashboard::class, 'edit']);
    Route::post('/dashboard/profile/{id}',[Dashboard::class, 'update']);

});

//Middleware => user : untuk user akses kedalam dashboard.
Route::group(['middleware' => ['auth', 'CheckRules:user']], function(){

        Route::post('/dashboard',[Dashboard::class, 'store']); //token store update
        Route::get('/notifikasi/reset/{serialnumber}',[Dashboard::class, 'reset']); //token store update
});

// Middleware => engineer : untuk monitoring oleh engineer dan check list alat selesai atau belum
Route::group(['middleware' => ['auth', 'CheckRules:engineer']], function(){

    Route::get('/dashboard/serialnumber',[AlatEngineer::class, 'index']);
    Route::post('/dashboard/serialnumber',[AlatEngineer::class, 'store']);
    Route::get('/dashboard/serialnumber/delete/{id}',[AlatEngineer::class, 'destroy']);

});

//router admin untuk registrasi
Route::group(['middleware' => ['auth', 'CheckRules:admin']], function(){

    Route::get('/dashboard/user/delete/{id}',[RegistrerEngineer::class, 'destroy']);
    Route::get('/dashboard/register',[RegistrerEngineer::class, 'index']);
    Route::post('/dashboard/register',[RegistrerEngineer::class, 'store']);

});

//lupa password
Route::get('/forgot',[ForgetPassword::class, 'index']);
Route::post('/forgot',[ForgetPassword::class, 'forgot']);
Route::get('/forgot/{email}/{token}',[ForgetPassword::class, 'reset']);
Route::post('/forgot/{email}/{token}',[ForgetPassword::class, 'new_password']);


// logout semua rules => user, admin, dan engineer
Route::post('/logout',[Logout::class, 'logout']);
Route::get('/logout',[Logout::class, 'logout_get']);

Route::get('/register',[Register::class, 'index']);
Route::post('/register',[Register::class, 'store']);
