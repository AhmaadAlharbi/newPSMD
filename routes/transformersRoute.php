<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\TransformersController;

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
Route::middleware(['auth','is_transformers'])->group(function(){
  Route::get('/dashboard/user/query_section_id=5',[TransformersController::class,'userIndex']);
  //engineer report form
  Route::get('/dashboard/user/query_section_id=5/Engineer-report-form/{id}',[TransformersController::class,
  'engineerReportForm'])->name('Transformers.engineerReportForm');
  Route::post('/Transformers/Egineer-report/{id}',[TransformersController::class,'SubmitEngineerReport'])
  ->name('Transformers.SubmitEngineerReport');
  Route::post('/Transformers/Egineer-report/uncompleted/{id}',[TransformersController::class,'engineerReportUnCompleted'])
  ->name('Transformers.engineerReportUnCompleted');
  Route::get('/dashboard/user/query_section_id=5/{id}',[TransformersController::class,'engineerPageTasks'])->name('Transformers.engineerPageTask');
  Route::get('/dashboard/user/query_section_id=5/{id}/completed',[TransformersController::class,'engineerPageTasksCompleted'])->name('TransformersController.engineerPageTaskCompleted');
  Route::get('/dashboard/user/query_section_id=5/{id}/pending',[TransformersController::class,'engineerPageTasksUnCompleted'])->name('TransformersController.engineerPageTaskUncompleted');
  Route::get('transformers/View_file/{id}/{file_name}', [TransformersController::class, 'open_file'])->name('transformers.view_file');
  Route::get('transformers/download/{id}/{file_name}', [TransformersController::class, 'get_file'])->name('transformers.download_file');
   // VIEW REPORT PRINT PAGE

  Route::get('/dashboard/user/query_section_id=5/print-report/{id}',[TransformersController::class,'viewPrintReport'])->name('Transformers.user.veiwReport');
  Route::get('/dashboard/user/archive/query_section_id=5/',[TransformersController::class,'userArchive'])->name('TransformersController.user.archive');
  Route::get('/dashboard/user/query_section_id=5/task-details/{id}',[TransformersController::class,'usertaskDetails'])->name('Transformers.user.taskDetails');
  //show user tasks page
  Route::get('/dashboard/user/query_section_id=5/engineer-tasks/{id}',[TransformersController::class,'showEngineerTasks'])->name('transformers.showEngineerTasks');
  Route::get('/dashboard/user/query_section_id=5/engineer-tasks-uncompleted/{id}',[TransformersController::class,'showEngineerTasksUncompleted'])->name('transformers.showEngineerTasksUncompleted');
  Route::get('/dashboard/user/query_section_id=5/engineer-tasks-completed/{id}',[TransformersController::class,'showEngineerTasksCompleted'])->name('transformers.showEngineerTasksCompleted');
  });

Route::middleware(['is_admin','is_transformers'])->group(function () {
    //main page

    Route::get('/dashboard/admin/query_section_id=5',[TransformersController::class,'index'])->name('dashboard.admin.Transformers');
    //add task for admins
    Route::get('/dashboard/admin/query_section_id=5/add_task',[TransformersController::class,'add_task'])->name('Transformers.addTask');
    //get  all engineer's name
    Route::get('/Transformers/getEngineer/{area_id}/{department}/{shift_id}',[TransformersController::class,'getEngineerName'])->name('Transformers.getEngineer');
    //get an engineer's email
    Route::get('/Transformers/getEngineersEmail/{id}', [TransformersController::class, 'getEngineersEmail']);
    //get an engineer based on shift
    Route::get('/Transformers/getEngineersOnShift/{area_id}/{shift_id}',[TransformersController::class,'getEngineersShift']);
    //get stations
    Route::get('/Transformers/stations/{id}',[TransformersController::class,'getStations']);
    //get admins ot tr section
    Route::get('/Transformers/getAdminEmail/{id}',[TransformersController::class,'getAdminsEmail']);

    Route::get('/Transformers/{area}/{section}',[TransformersController::class,'getAdmins']);
    //get user in tr secttion
    Route::get('/Transformers/getUserEmail/{id}',[TransformersController::class,'getUserEmail']);
    ///BACKEND ROUTE
    Route::post('/Transformers/send_task',[TransformersController::class,'store'])->name('Transformers.store');
    Route::get('/dashboard/admin/query_section_id=5/All-tasks',[TransformersController::class,'showAllTasks'])->name('Transformers.admin.showAllTasks');
    Route::get('/dashboard/admin/query_section_id=5/pending-tasks',[TransformersController::class,'showPendingTasks'])->name('Transformers.admin.pendingTasks');
    Route::get('/dashboard/admin/query_section_id=5/completed-tasks',[TransformersController::class,'showCompletedTasks'])->name('Transformers.admin.completedTasks');
    Route::get('/dashboard/admin/query_section_id=5/archive',[TransformersController::class,'showArchive'])->name('Transformers.admin.archive');
    Route::get('/dashboard/admin/query_section_id=5/task-details/{id}',[TransformersController::class,'taskDetails'])->name('Transformers.admin.taskDetails');
    Route::get('/dashboard/admin/query_section_id=5/engineers_list',[TransformersController::class,'showEngineers'])->name('Transformers.engineers');
    Route::get('/dashboard/admin/query_section_id=5/update-task/{id}',[TransformersController::class,'updateTask'])->name('Transformers.updateTask');
    Route::post('/dashboard/admin/query_section_id=5/update-task/{id}',[TransformersController::class,'update'])->name('Transformers.update');
    Route::delete('/dashboard/admin/query_section_id=5/deleteTask',[TransformersController::class,'destroyTask'])->name('Transformers.destroyTask');
    Route::post('/Transformers/addEngineer',[TransformersController::class,'addEngineer'])->name('Transformers.addEngineer');
  //attachments
    Route::post('delete_file', [TransformersController::class, 'destroyAttachment'])->name('delete_file');
    // VIEW REPORT PRINT PAGE
    Route::get('/dashboard/admin/query_section_id=5/print-report/{id}',[TransformersController::class,'viewPrintReport'])->name('Transformers.veiwReport');


    });