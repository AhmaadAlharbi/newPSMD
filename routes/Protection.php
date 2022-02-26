<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\ProtectionController;


// /#########USER ROUTES ##################
// Route::get('/dashboard/user/query_section_id=2', function () {
//     return view('protection.user.dashboard');
// })->middleware(['auth','is_protection'])->name('dashboard.user.protection');

Route::middleware(['auth','is_protection'])->group(function(){
Route::get('/dashboard/user/query_section_id=2',[ProtectionController::class,'userIndex']);
//engineer report form
Route::get('/dashboard/user/query_section_id=2/Engineer-report-form/{id}',[ProtectionController::class,
'engineerReportForm'])->name('protection.engineerReportForm');
Route::post('/protection/Egineer-report/{id}',[ProtectionController::class,'SubmitEngineerReport'])
->name('proteciton.SubmitEngineerReport');
Route::post('/protection/Egineer-report/uncompleted/{id}',[ProtectionController::class,'engineerReportUnCompleted'])
->name('proteciton.engineerReportUnCompleted');
Route::get('/dashboard/user/query_section_id=2/{id}',[ProtectionController::class,'engineerPageTasks'])->name('protection.engineerPageTask');
Route::get('/dashboard/user/query_section_id=2/{id}/completed',[ProtectionController::class,'engineerPageTasksCompleted'])->name('protection.engineerPageTaskCompleted');
Route::get('/dashboard/user/query_section_id=2/{id}/pending',[ProtectionController::class,'engineerPageTasksUnCompleted'])->name('protection.engineerPageTaskUncompleted');
Route::get('/dashboard/user/query_section_id=2/task-details/{id}',[ProtectionController::class,'usertaskDetails'])->name('protecion.user.taskDetails');
Route::get('/protection/View_file/{id}/{file_name}', [ProtectionController::class, 'open_file'])->name('protection.view_file');
Route::get('/protection/download/{id}/{file_name}', [ProtectionController::class, 'get_file'])->name('protection.download_file');
Route::get('/dashboard/user/query_section_id=2/print-report/{id}',[ProtectionController::class,'viewPrintReport'])->name('protection.user.veiwReport');
Route::get('/dashboard/user/archive/query_section_id=2/',[ProtectionController::class,'userArchive'])->name('protection.user.archive');
// VIEW REPORT PRINT PAGE
Route::get('/dashboard/user/query_section_id=2/task-details/{id}',[ProtectionController::class,'taskDetails'])->name('protection.user.taskDetails');
//request form engineer to edit his report
Route::get('/dashboard/user/query_section_id=2/request-to-edit-report/{id}',[ProtectionController::class,'editReport'])->name('protection.editReport');
//show user tasks page
Route::get('/dashboard/user/query_section_id=2/engineer-tasks/{id}',[ProtectionController::class,'showEngineerTasks'])->name('protection.showEngineerTasks');
Route::get('/dashboard/user/query_section_id=2/engineer-tasks-uncompleted/{id}',[ProtectionController::class,'showEngineerTasksUncompleted'])->name('protection.showEngineerTasksUncompleted');
Route::get('/dashboard/user/query_section_id=2/engineer-tasks-completed/{id}',[ProtectionController::class,'showEngineerTasksCompleted'])->name('protection.showEngineerTasksCompleted');

});
// /#########ADMIN ROUTES ##################
Route::middleware(['is_admin','is_protection'])->group(function () {
    //main page
    Route::get('/dashboard/admin/query_section_id=2',[ProtectionController::class,'index'])->name('dashboard.admin.protection');
    //add task
    Route::get('/dashboard/admin/query_section_id=2/add_task',[ProtectionController::class,'add_task'])->name('protection.addTask');
    //get  all engineer's name
    Route::get('/getEngineer/{area_id}/{shift_id}',[ProtectionController::class,'getEngineerName'])->name('protection.getEngineer');
    //get an engineer's email
    Route::get('/getEngineersEmail/{id}', [ProtectionController::class, 'getEngineersEmail']);
    //get an engineer based on shift
    Route::get('/getEngineersOnShift/{area_id}/{shift_id}',[ProtectionController::class,'getEngineersShift']);
    //get stations
    Route::get('/stations/{id}',[ProtectionController::class,'getStations']);
    Route::get('/protection/getUserEmail/{id}',[ProtectionController::class,'getUserEmail']);
    ///*****BACKEND ROUTE *********
    Route::post('/protection/send_task',[ProtectionController::class,'store'])->name('protection.store');
    Route::get('/dashboard/admin/query_section_id=2/All-tasks',[ProtectionController::class,'showAllTasks'])->name('protection.admin.showAllTasks');
    Route::get('/dashboard/admin/query_section_id=2/pending-tasks',[ProtectionController::class,'showPendingTasks'])->name('protection.admin.pendingTasks');
    Route::get('/dashboard/admin/query_section_id=2/completed-tasks',[ProtectionController::class,'showCompletedTasks'])->name('protection.admin.completedTasks');
    Route::get('/dashboard/admin/query_section_id=2/archive',[ProtectionController::class,'showArchive'])->name('protection.admin.archive');
    Route::get('/dashboard/admin/query_section_id=2/task-details/{id}',[ProtectionController::class,'taskDetails'])->name('protection.admin.taskDetails');
    Route::get('/dashboard/admin/query_section_id=2/engineers_list',[ProtectionController::class,'showEngineers'])->name('protection.engineers');
     //add engineer
    Route::post('/dashboard/admin/query_section_id=2/add-engineer',[ProtectionController::class,'addEngineer'])->name('protection.addEngineer');

    Route::get('/dashboard/admin/query_section_id=2/update-task/{id}',[ProtectionController::class,'updateTask'])->name('protection.updateTask');
    Route::post('/dashboard/admin/query_section_id=2/update-task/{id}',[ProtectionController::class,'update'])->name('protection.update');
    Route::delete('/dashboard/admin/query_section_id=2/deleteTask',[ProtectionController::class,'destroyTask'])->name('protection.destroyTask');
  //attachments
    Route::post('delete_file', [ProtectionController::class, 'destroyAttachment'])->name('delete_file');
    // VIEW REPORT PRINT PAGE
    Route::get('/dashboard/admin/query_section_id=2/print-report/{id}',[ProtectionController::class,'viewPrintReport'])->name('protection.veiwReport');

    });
    
    Route::get('/dashboard/admin/stations-list',[ProtectionController::class,'showStations'])->name('stationsList')->middleware('auth');


require __DIR__ . '/auth.php';