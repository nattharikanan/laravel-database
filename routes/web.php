<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;     //การใช้ query 
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //ข้อมูลมาจาก models User
    /*$user = User::all();*/

    //การใช้ query 
    $user = DB::table('users')->get();
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //departments
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department'); //import department controller ด้วย
    Route::post('/department/add',[DepartmentController::class,'insert'])->name('insertDepartment');
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit'])->name('editDepartment');
    Route::post('/department/update/{id}',[DepartmentController::class,'update'])->name('updateDepartment');
    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete'])->name('softdeleteDepartment');
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore'])->name('restoreDepartment');
    Route::get('/department/focedelete/{id}',[DepartmentController::class,'focedelete'])->name('focedeleteDepartment');

    //services
    Route::get('/service/all',[ServiceController::class,'index'])->name('service');
    Route::post('/service/add',[ServiceController::class,'insert'])->name('insertService');
});