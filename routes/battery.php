<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\BatteryController;

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
Route::middleware(['auth','is_battery'])->group(function(){
  Route::get('/dashboard/user/query_section_id=3',[BatteryController::class,'userIndex']);
  //engineer report form
  Route::get('/dashboard/user/query_section_id=3/Engineer-report-form/{id}',[BatteryController::class,
  'engineerReportForm'])->name('battery.engineerReportForm');
  Route::post('/battery/Egineer-report/{id}',[BatteryController::class,'SubmitEngineerReport'])
  ->name('battery.SubmitEngineerReport');
  Route::post('/battery/Egineer-report/uncompleted/{id}',[BatteryController::class,'engineerReportUnCompleted'])
  ->name('battery.engineerReportUnCompleted');
  Route::get('/dashboard/user/query_section_id=3/{id}',[BatteryController::class,'engineerPageTasks'])->name('battery.engineerPageTask');
  Route::get('/dashboard/user/query_section_id=3/{id}/completed',[BatteryController::class,'engineerPageTasksCompleted'])->name('battery.engineerPageTaskCompleted');
  Route::get('/dashboard/user/query_section_id=3/{id}/pending',[BatteryController::class,'engineerPageTasksUnCompleted'])->name('battery.engineerPageTaskUncompleted');
  Route::get('View_file/{id}/{file_name}', [BatteryController::class, 'open_file'])->name('view_file');
  Route::get('download/{id}/{file_name}', [BatteryController::class, 'get_file']);
  Route::get('/dashboard/user/query_section_id=3/print-report/{id}',[BatteryController::class,'viewPrintReport'])->name('battery.user.veiwReport');
  Route::get('/dashboard/user/archive/query_section_id=3/',[BatteryController::class,'userArchive'])->name('battery.user.archive');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/user/query_section_id=3/task-details/{id}',[BatteryController::class,'taskDetails'])->name('battery.user.taskDetails');
  
});
Route::middleware(['is_admin','is_battery'])->group(function () {
    //main page

    Route::get('/dashboard/admin/query_section_id=3',[BatteryController::class,'index'])->name('dashboard.admin.battery p');
    //add task
    Route::get('/dashboard/admin/query_section_id=3/add_task',[BatteryController::class,'add_task'])->name('battery.addTask');
    //get  all engineer's name
    Route::get('/battery/getEngineer/{area_id}/{shift_id}',[BatteryController::class,'getEngineerName'])->name('battery.getEngineer');
    //get an engineer's email
    Route::get('/battery/getEngineersEmail/{id}', [BatteryController::class, 'getEngineersEmail']);
    //get an engineer based on shift
    Route::get('/battery/getEngineersOnShift/{area_id}/{shift_id}',[BatteryController::class,'getEngineersShift']);
    //get stations
    Route::get('/battery/stations/{id}',[BatteryController::class,'getStations']);

    ///BACKEND ROUTE
    Route::post('/battery/send_task',[BatteryController::class,'store'])->name('battery.store');
    Route::get('/dashboard/admin/query_section_id=3/All-tasks',[BatteryController::class,'showAllTasks'])->name('battery.admin.showAllTasks');
    Route::get('/dashboard/admin/query_section_id=3/pending-tasks',[BatteryController::class,'showPendingTasks'])->name('battery.admin.pendingTasks');
    Route::get('/dashboard/admin/query_section_id=3/completed-tasks',[BatteryController::class,'showCompletedTasks'])->name('battery.admin.completedTasks');
    Route::get('/dashboard/admin/query_section_id=3/archive',[BatteryController::class,'showArchive'])->name('battery.admin.archive');
    Route::get('/dashboard/admin/query_section_id=3/task-details/{id}',[BatteryController::class,'taskDetails'])->name('battery.admin.taskDetails');
    Route::get('/dashboard/admin/query_section_id=3/engineers_list',[BatteryController::class,'showEngineers'])->name('battery.engineers');
    Route::get('/dashboard/admin/query_section_id=3/update-task/{id}',[BatteryController::class,'updateTask'])->name('battery.updateTask');
    Route::post('/dashboard/admin/query_section_id=3/update-task/{id}',[BatteryController::class,'update'])->name('battery.update');
    Route::delete('/dashboard/admin/query_section_id=3/deleteTask',[BatteryController::class,'destroyTask'])->name('battery.destroyTask');
    Route::post('/battery/addEngineer',[BatteryController::class,'addEngineer'])->name('battery.addEngineer');
  //attachments
    Route::post('delete_file', [BatteryController::class, 'destroyAttachment'])->name('delete_file');
    // VIEW REPORT PRINT PAGE
    Route::get('/dashboard/admin/query_section_id=3/print-report/{id}',[BatteryController::class,'viewPrintReport'])->name('battery.veiwReport');


    });