<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\FireFightingController;

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
Route::middleware(['auth','is_fireFighting'])->group(function(){
  Route::get('/dashboard/user/query_section_id=4',[FireFightingController::class,'userIndex']);
  //engineer report form
  Route::get('/dashboard/user/query_section_id=4/Engineer-report-form/{id}',[FireFightingController::class,
  'engineerReportForm'])->name('FireFighting.engineerReportForm');
  Route::post('/FireFighting/Egineer-report/{id}',[FireFightingController::class,'SubmitEngineerReport'])
  ->name('FireFighting.SubmitEngineerReport');
  Route::post('/FireFighting/Egineer-report/uncompleted/{id}',[FireFightingController::class,'engineerReportUnCompleted'])
  ->name('FireFighting.engineerReportUnCompleted');
  Route::get('/dashboard/user/query_section_id=4/{id}',[FireFightingController::class,'engineerPageTasks'])->name('FireFighting.engineerPageTask');
  Route::get('/dashboard/user/query_section_id=4/{id}/completed',[FireFightingController::class,'engineerPageTasksCompleted'])->name('FireFighting.engineerPageTaskCompleted');
  Route::get('/dashboard/user/query_section_id=4/{id}/pending',[FireFightingController::class,'engineerPageTasksUnCompleted'])->name('FireFighting.engineerPageTaskUncompleted');
  Route::get('View_file/{id}/{file_name}', [FireFightingController::class, 'open_file'])->name('view_file');
  Route::get('download/{id}/{file_name}', [FireFightingController::class, 'get_file']);
  Route::get('/dashboard/user/query_section_id=4/print-report/{id}',[FireFightingController::class,'viewPrintReport'])->name('FireFighting.user.veiwReport');
  Route::get('/dashboard/user/archive/query_section_id=4/',[FireFightingController::class,'userArchive'])->name('FireFighting.user.archive');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/user/query_section_id=4/task-details/{id}',[FireFightingController::class,'taskDetails'])->name('FireFighting.user.taskDetails');
  
});
Route::middleware(['is_admin','is_fireFighting'])->group(function () {
    //main page

    Route::get('/dashboard/admin/query_section_id=4',[FireFightingController::class,'index'])->name('dashboard.admin.FireFighting p');
    //add task
    Route::get('/dashboard/admin/query_section_id=4/add_task',[FireFightingController::class,'add_task'])->name('FireFighting.addTask');
    //get  all engineer's name
    Route::get('/FireFighting/getEngineer/{area_id}/{shift_id}',[FireFightingController::class,'getEngineerName'])->name('FireFighting.getEngineer');
    //get an engineer's email
    Route::get('/FireFighting/getEngineersEmail/{id}', [FireFightingController::class, 'getEngineersEmail']);
    //get an engineer based on shift
    Route::get('/FireFighting/getEngineersOnShift/{area_id}/{shift_id}',[FireFightingController::class,'getEngineersShift']);
    //get stations
    Route::get('/FireFighting/stations/{id}',[FireFightingController::class,'getStations']);

    ///BACKEND ROUTE
    Route::post('/FireFighting/send_task',[FireFightingController::class,'store'])->name('FireFighting.store');
    Route::get('/dashboard/admin/query_section_id=4/All-tasks',[FireFightingController::class,'showAllTasks'])->name('FireFighting.admin.showAllTasks');
    Route::get('/dashboard/admin/query_section_id=4/pending-tasks',[FireFightingController::class,'showPendingTasks'])->name('FireFighting.admin.pendingTasks');
    Route::get('/dashboard/admin/query_section_id=4/completed-tasks',[FireFightingController::class,'showCompletedTasks'])->name('FireFighting.admin.completedTasks');
    Route::get('/dashboard/admin/query_section_id=4/archive',[FireFightingController::class,'showArchive'])->name('FireFighting.admin.archive');
    Route::get('/dashboard/admin/query_section_id=4/task-details/{id}',[FireFightingController::class,'taskDetails'])->name('FireFighting.admin.taskDetails');
    Route::get('/dashboard/admin/query_section_id=4/engineers_list',[FireFightingController::class,'showEngineers'])->name('FireFighting.engineers');
    Route::get('/dashboard/admin/query_section_id=4/update-task/{id}',[FireFightingController::class,'updateTask'])->name('FireFighting.updateTask');
    Route::post('/dashboard/admin/query_section_id=4/update-task/{id}',[FireFightingController::class,'update'])->name('FireFighting.update');
    Route::delete('/dashboard/admin/query_section_id=4/deleteTask',[FireFightingController::class,'destroyTask'])->name('FireFighting.destroyTask');
    Route::post('/FireFighting/addEngineer',[FireFightingController::class,'addEngineer'])->name('FireFighting.addEngineer');
  //attachments
    Route::post('delete_file', [FireFightingController::class, 'destroyAttachment'])->name('delete_file');
    // VIEW REPORT PRINT PAGE
    Route::get('/dashboard/admin/query_section_id=4/print-report/{id}',[FireFightingController::class,'viewPrintReport'])->name('FireFighting.veiwReport');


    });