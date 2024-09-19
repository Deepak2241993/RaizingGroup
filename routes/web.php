<?php

use Illuminate\Support\Facades\Route;
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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AdminController::class,'login']);
Route::get('/logout',[AdminController::class,'logout']);
Route::post('/login',[AdminController::class,'AuthLogin'])->name('login');



Route::post('/user_type','StaffTaskController@UserType')->name('user_type');


Route::post('/findbrandname','EmployeeController@findbrandname')->name('findbrandname');

//  For Password Rest Route
Route::get('/password-reset-view','AdminController@passwordResetview')->name('passwordResetview');
Route::post('/password-reset','AdminController@passwordReset')->name('passwordReset');
Route::get('/password-reserform/{token}','AdminController@passwordResetForm')->name('reserform');
Route::post('/password-finalreset','AdminController@passwordfinalReset')->name('finalreset');
 //  For Password Rest Route End

Route::prefix('master-admin')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('master-dashboard');
    Route::resource('/company',CompanyController::class);
    Route::resource('/brands',BrandController::class);
    Route::resource('/tasks',MytaskController::class);
    Route::resource('/admin',MytaskController::class);
    Route::post('/statusUpdate/{id}','MytaskController@statusUpdate')->name('statusUpdate');
    Route::get('/admins','AdminController@index')->name('adminlist');
    Route::get('/admins/{id}','AdminController@edit')->name('admins_edit');
    Route::post('/admin/create','AdminController@store')->name('admins_create');
    Route::post('/admin/update/{id}','AdminController@update')->name('admins_update');
    Route::post('/admins/{id}','AdminController@destroy')->name('admins_delete');
    Route::resource('/employee',EmployeeController::class);
    Route::resource('/customer-query',CustomerQueryController::class);
    Route::resource('/holiday',HolidayController::class);
    Route::resource('/vendor',VendorController::class);
    Route::resource('/vendor-task',VendorTaskAssignController::class);
    Route::resource('/leave',EmpLeaveController::class);
    Route::resource('/employeetask',EmployeeTaskController::class);
    Route::resource('/admintask',AdminTaskController::class);
    Route::resource('/managementtask',StaffTaskController::class);
    Route::post('/employee_task_update/{id}','EmployeeTaskController@employee_task_update')->name('employee_task_update');
    Route::post('/admin_task_update/{id}','AdminTaskController@admin_task_update')->name('admin_task_update');
    Route::get('/admin-leave','EmpLeaveController@AdminLeave')->name('AdminLeave');
    Route::get('/emp-leave','EmpLeaveController@EmpLeave')->name('EmpLeave');
    Route::post('/EmpLeaveStatusApprove/{id}','EmpLeaveController@EmpLeaveStatusApprove')->name('EmpLeaveStatusApprove');
    Route::post('/primary_leave_status','EmpLeaveController@primary_leave_status')->name('primary_leave_status');
    Route::post('/EmpLeaveStatusReject/{id}','EmpLeaveController@EmpLeaveStatusReject')->name('EmpLeaveStatusReject');
    Route::post('/AdminLeaveStatusApprove/{id}','EmpLeaveController@AdminLeaveStatusApprove')->name('AdminLeaveStatusApprove');
    Route::post('/AdminLeaveStatusReject/{id}','EmpLeaveController@AdminLeaveStatusReject')->name('AdminLeaveStatusReject');
    Route::resource('/settings',WebsitesettingController::class);
    Route::resource('/login_details',LoginDetailsController::class);
    Route::get('/viewholidays/{id}','HolidayController@holidayview')->name('viewholidays');
 
    
});

//  Admin Route
Route::prefix('admin')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'Adminindex'])->name('admin-dashboard');
    Route::resource('/managementtask',StaffTaskController::class);
    Route::resource('/holiday',HolidayController::class);
    Route::get('/viewholidays/{id}','HolidayController@holidayview')->name('viewholidays');

});

//  HR Route
Route::prefix('hr')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'HRindex'])->name('hr-dashboard');
    Route::resource('/managementtask',StaffTaskController::class);
    Route::resource('/holiday',HolidayController::class);
    Route::get('/viewholidays/{id}','HolidayController@holidayview')->name('viewholidays');

});

//  Employee Route
Route::prefix('employee')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'Employeeindex'])->name('employee-dashboard');
    Route::resource('/customer-query',CustomerQueryController::class);
    Route::resource('/employeetask',EmployeeTaskController::class);
    Route::resource('/leave',EmpLeaveController::class);
    Route::get('/employeetaskview','EmployeeTaskController@employeetaskview')->name('employeetaskview');
    Route::get('/emp-leave-status','EmpLeaveController@EmpLeaveStatus')->name('EmpLeaveStatus');
    Route::resource('/managementtask',StaffTaskController::class);
    Route::resource('/holiday',HolidayController::class);
    Route::get('/viewholidays/{id}','HolidayController@holidayview')->name('viewholidays');

});

// Vendor Dashboard
//  Vendor Route
Route::prefix('vendor')->middleware('login')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'Vendorindex'])->name('vendor-dashboard');
    Route::resource('/vendor-task',VendorTaskAssignController::class);

});

Route::get('/cache', function() {
    Artisan::call('cache:clear ');
    echo Artisan::output();
});
Route::get('/route', function() {
    Artisan::call('route:clear');
    echo Artisan::output();
});
Route::get('/config', function() {
    Artisan::call('config:clear');
    echo Artisan::output();
});
Route::get('/view', function() {
    Artisan::call('view:clear');
    echo Artisan::output();
});

Route::get('/command', function() {
    Artisan::call('make:model Language -mcr');
    Artisan::call('db:seed');
    Artisan::call('db:seed');
    echo Artisan::output();
});


