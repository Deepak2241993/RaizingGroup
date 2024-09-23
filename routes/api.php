<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MytaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerQueryController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorTaskAssignController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\AdminTaskController;
use App\Http\Controllers\WebsitesettingController;
use App\Http\Controllers\StaffTaskController;
use App\Http\Controllers\LoginDetailsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// For Authintication
Route::post('/login_alluser', [ApiController::class, 'AuthLogin']);
Route::post('/logout_alluser',[ApiController::class,'logout']);

// For Company and Brand
Route::post('/company', [CompanyController::class, 'store']);


// For Company and Brand
Route::post('/dashboard', [ApiController::class, 'dashboard']);
