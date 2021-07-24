<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::get('/', [HomeController::class, 'index'])->name('home'); //Homepage Route

Route::get('/post/{post}', [PostController::class, 'show'])->name('post');


//--------- Search Bar ----------


Route::post('/search', [HomeController::class, 'search_employee'])->name('search.employee'); 



Route::middleware('auth')->group(function(){


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


Route::get('/profile', [HomeController::class, 'show'])->name('user.show');

Route::put('/profile', [HomeController::class, 'update'])->name('user.update');




Route::get('/admin/role', [RoleController::class, 'create_role'])->name('create.role');

Route::post('/admin/create_role', [RoleController::class, 'store'])->name('role.store');

Route::get('/admin/all_roles', [RoleController::class, 'show'])->name('show.roles');

Route::get('/admin/role/delete/{role}', [RoleController::class, 'delete'])->name('role_delete');

Route::get('/admin/role/edit/{role}', [RoleController::class, 'edit'])->name('role_edit');

Route::post('/admin/role/update/{role}', [RoleController::class, 'update'])->name('role_update');

/////////////// ROLE MANAGEMENT ////

Route::get('/user_role_manage', [RoleController::class, 'user_role_manage'])->name('user_role_manage');

Route::get('/add_user_role/{user}', [RoleController::class, 'add_user_role'])->name('add_user_role');

Route::post('/user_role_create/{user}', [RoleController::class, 'user_role_create'])->name('user_role_create');

Route::get('/delete_user_role/{user}', [RoleController::class, 'delete_user_role'])->name('delele_user_role');
Route::post('/user_role_deleted/{user}', [RoleController::class, 'user_role_deleted'])->name('user_role_deleted');




///////////  KAJ NAI 


// Route::resource('employee', EmployeeController::class);
//EMPLOYEE DATA PDF//
Route::get('/emp_print/{id}', [InvoiceController::class, 'emp_data_print'])->name('emp_data_print');
//EMPLOYEE GUEST DATA PDF//
Route::get('/print_page', [InvoiceController::class, 'print_page'])->name('print.page');


//----GO TO ADMIN DASHBOARD AND SHOW REPORT FORM----//
Route::get('/admin_reports', [AdminController::class, 'admin_reports'])->name('admin.reports');
Route::get('/contractual_worker', [AdminController::class, 'contractual_worker'])->name('contractual_worker.report');
// Attendance Reports
Route::get('/admin_attendance_reports', [AdminController::class, 'admin_attendance_reports'])->name('admin.attendance_reports');

Route::get('/today_guest', [AdminController::class, 'today_emp_guest'])->name('admin.today_emp_guest');


Route::get('/today_con_worker', [AdminController::class, 'today_con_worker'])->name('admin.today_con_worker');

Route::get('/today_vehicle', [AdminController::class, 'today_vehicle'])->name('admin.today_vehicle');


//----GO TO ADMIN DASHBOARD AND SHOW REPORTS----//
Route::post('/report_generates', [AdminController::class, 'report_generates'])->name('report.generates');
Route::post('/workers_report_generates', [AdminController::class, 'contractual_worker_report'])->name('report.contractual_worker');
Route::post('/attendance_report_generates', [AdminController::class, 'attendance_report_generates'])->name('attendance_report.generates');

Route::get('/vehicle_reports', [AdminController::class, 'vehicle_reports'])->name('admin.vehicle_reports');


Route::post('/vehicle_report_generates', [AdminController::class, 'vehicle_report_generates'])->name('vehicle_report.generates');

Route::resource('guest', GuestController::class);

Route::get('/guest_employee', 'GuestController@employeeindex')->name('guest.employee');
//----GO TO MANAGEMENT DASHBOARD AND SHOW MANAGEMENT GUEST FORM ----//
Route::get('/management', 'GuestController@managementindex')->name('guest.management');
//----GO TO MANAGEMENT DASHBOARD AND SHOW SPECIAL GUEST FORM ----//
Route::get('/special', 'GuestController@specialindex')->name('guest.special');
//----GO TO ADMIN DASHBOARD AND SHOW ALL EMPLOYEE DETAIL'S----//
Route::get('/view_all_employee','GuestController@view_employee')->name('guest.view_all_employee');


Route::resource('attendance', AttendanceController::class);
Route::get('/emp_getToken/{id}', 'AttendanceController@attendance_get_token')->name('attendance.get_token');
Route::get('/truncate_form', 'AttendanceController@truncate_form')->name('attendance.truncate_form');
Route::post('/truncate', 'AttendanceController@truncate')->name('attendance.truncate');
Route::get('/attendance_data', 'AttendanceController@attendance_form')->name('attendance.form');
Route::post('/attendance_datasheet', 'AttendanceController@attendance_datasheet')->name('attendance.datasheet');


Route::resource('employee', EmployeeController::class);

Route::get('/manager_view_employee', 'EmployeeController@manager_view_employee')->name('employee.view_employee');

Route::get('emp_name_search', 'EmployeeController@emp_name_search');

Route::get('rfid_search', 'RfidController@rfid_search')->name('rfid_search');



Route::resource('rfid',  RfidController::class);
Route::post('rfid_return',  'RfidController@return')->name('rfid.return');


//Vehicle Entry
Route::resource('vehicle',  VehicleController::class);

Route::resource('company_vehicle',  CompanyVehicleController::class);


});