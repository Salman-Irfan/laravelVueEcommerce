<?php

use App\Http\Controllers\API\UserControllers\AuthControllers\AdminLoginController;
use App\Http\Controllers\API\UserControllers\AuthControllers\RegisterUserController;
use App\Http\Controllers\API\UserControllers\AuthControllers\UserLoginController;
// admin controllers
use App\Http\Controllers\API\Admin\ProductControllers;
// use App\Http\Controllers\API\Admin\ProductControllers;
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
// login middleware - get logged in user on the basis of token
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/admin/products', [ProductControllers::class, 'index']);

// User registration route
Route::post('/register', [RegisterUserController::class, 'register']);
// User login route
Route::post('/login', [UserLoginController::class, 'login']);
// Admin User Login
Route::post('/admin/login', [AdminLoginController::class, 'adminLogin']);