<?php

use App\Http\Controllers\API\UserControllers\AuthControllers\AdminLoginController;
use App\Http\Controllers\API\UserControllers\AuthControllers\RegisterUserController;
use App\Http\Controllers\API\UserControllers\AuthControllers\UserLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// login middleware
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 'admin' middleware
Route::middleware(['admin'])->group(function () {
    // Define your admin-only API routes here

    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::post('/admin/create', 'AdminController@create');
    
    // Add more admin routes as needed
});

// This specific route is protected by the 'admin' middleware
Route::get('/admin/specific-route', 'AdminController@specificRoute')->middleware('admin');


// User registration route
Route::post('/register', [RegisterUserController::class, 'register']);
// User login route
Route::post('/login', [UserLoginController::class, 'login']);
// Admin User Login
Route::post('/admin/login', [AdminLoginController::class, 'adminLogin']);