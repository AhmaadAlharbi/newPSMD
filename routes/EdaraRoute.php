<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\EdaraController; 


Route::middleware(['is_admin','is_protection'])->group(function () {
    //main page
    Route::get('/dashboard/admin/query_section_id=1',[EdaraController::class,'index'])->name('dashboard.admin.edara');
    //add task to be assinged
    Route::get('/dashboard/admin/query_section_id=1/add_task_to_be_assigned',[EdaraController::class,'assign_task'])->name('edara.assign_task');
    Route::post('/edara/assignTasks',[EdaraController::class,'storeAssignTask'])->name('edara.store.assign_task');

    //get stations
    Route::get('/Edara/stations/{id}',[EdaraController::class,'getStations']);
    //change task section
    Route::get('/dashboard/admin/query_section_id=1/change-section-page/{id}',[EdaraController::class,'changeSectionView'])->name('edara.changeSectionView');
    Route::get('/edara/change-section/{id}',[EdaraController::class,'changeSection'])->name('edara.changeSection');
 //change section page
    Route::get('/dashboard/admin/query_section_id=1/change-section-page/{id}',[EdaraController::class,'changeSectionView'])->name('edara.changeSectionView');
    Route::post('/edara/assignTasks',[EdaraController::class,'storeAssignTask'])->name('edara.store.assign_task');
    Route::get('/dashboard/admin/query_section_id=1/All-tasks',[EdaraController::class,'showAllTasks'])->name('edara.admin.showAllTasks');
    Route::get('/dashboard/admin/query_section_id=1/pending-tasks',[EdaraController::class,'showPendingTasks'])->name('edara.admin.pendingTasks');
    Route::get('/dashboard/admin/query_section_id=1/completed-tasks',[EdaraController::class,'showCompletedTasks'])->name('edara.admin.completedTasks');
    Route::get('/dashboard/admin/query_section_id=1/archive',[EdaraController::class,'showArchive'])->name('edara.admin.archive');
    Route::get('/dashboard/admin/query_section_id=1/task-details/{id}',[EdaraController::class,'taskDetails'])->name('edara.admin.taskDetails');
    Route::get('/dashboard/admin/query_section_id=1/users_list',[EdaraController::class,'showUsers'])->name('edara.users');
    Route::get('/dashboard/admin/query_section_id=1/update-task/{id}',[EdaraController::class,'updateTask'])->name('edara.updateTask');
    Route::post('/dashboard/admin/query_section_id=1/update-task/{id}',[EdaraController::class,'update'])->name('edara.update');
    Route::delete('/dashboard/admin/query_section_id=1/deleteTask',[EdaraController::class,'destroyTask'])->name('edara.destroyTask');
    //attachments
    Route::get('edara/View_file/{id}/{file_name}', [EdaraController::class, 'open_file'])->name('edara.view_file');
    Route::get('edara/download/{id}/{file_name}', [EdaraController::class, 'get_file'])->name('edara.download_file');
    Route::post('delete_file', [ProtectionController::class, 'destroyAttachment'])->name('delete_file');
    // VIEW REPORT PRINT PAGE
    Route::get('/dashboard/admin/query_section_id=1/print-report/{id}',[EdaraController::class,'viewPrintReport'])->name('edara.veiwReport');
    Route::get('/dashboard/admin/query_section_id=1/print-common-report/{id}/{section_id}',[EdaraController::class,'viewCommonReport'])->name('edara.viewCommonReport');
    //to register new users to protection
    Route::get('/register/edara',[EdaraController::class,'registerPage'])->name('edara.registerPage');
    Route::post('/register/edara/signup',[EdaraController::class,'register'])->name('edara.register');
});