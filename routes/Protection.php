<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\ProtectionController;
use App\Http\Controllers\GeneralCheckControllerProtection;


// /#########USER ROUTES ##################
// Route::get('/dashboard/user/query_section_id=2', function () {
//     return view('protection.user.dashboard');
// })->middleware(['auth','is_protection'])->name('dashboard.user.protection');

Route::middleware(['auth', 'is_protection'])->group(function () {
  Route::get('/dashboard/user/query_section_id=2/add-duty-report', [ProtectionController::class, 'addDutyReport'])->name('protection.addDutyReport');
  Route::post('/dashboard/user/query_section_id=2/submit-duty-report', [ProtectionController::class, 'submitDutyReport'])->name('protection.submitDutyReport');
  Route::get('/dashboard/user/query_section_id=2/show-report/{id}', [ProtectionController::class, 'printDutyReport'])->name('protection.printDutyReport');

  Route::get('/dashboard/user/query_section_id=2', [ProtectionController::class, 'userIndex'])->name('protection.user.homepage');
  //engineer report form
  Route::get('/dashboard/user/query_section_id=2/Engineer-report-form/{id}', [
    ProtectionController::class,
    'engineerReportForm'
  ])->name('protection.engineerReportForm');
  Route::post('/protection/Egineer-report/{id}', [ProtectionController::class, 'SubmitEngineerReport'])
    ->name('proteciton.SubmitEngineerReport');
  Route::post('/protection/Egineer-report/uncompleted/{id}', [ProtectionController::class, 'engineerReportUnCompleted'])
    ->name('proteciton.engineerReportUnCompleted');
  Route::get('/dashboard/user/query_section_id=2/{id}', [ProtectionController::class, 'engineerPageTasks'])->name('protection.engineerPageTask');
  Route::get('/dashboard/user/query_section_id=2/{id}/completed', [ProtectionController::class, 'engineerPageTasksCompleted'])->name('protection.engineerPageTaskCompleted');
  Route::get('/dashboard/user/query_section_id=2/{id}/pending', [ProtectionController::class, 'engineerPageTasksUnCompleted'])->name('protection.engineerPageTaskUncompleted');
  // Route::get('/dashboard/user/query_section_id=2/task-details/{id}',[ProtectionController::class,'usertaskDetails'])->name('protecion.user.taskDetails');
  Route::get('/protection/View_file/{id}/{file_name}', [ProtectionController::class, 'open_file'])->name('protection.view_file');
  Route::get('/protection/download/{id}/{file_name}', [ProtectionController::class, 'get_file'])->name('protection.download_file');
  Route::get('/dashboard/user/query_section_id=2/print-report/{id}', [ProtectionController::class, 'viewPrintReport'])->name('protection.user.veiwReport');
  Route::get('/dashboard/user/archive/query_section_id=2/', [ProtectionController::class, 'userArchive'])->name('protection.user.archive');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/user/query_section_id=2/task-details/{id}', [ProtectionController::class, 'taskDetails'])->name('protection.user.taskDetails');
  //request form engineer to edit his report
  Route::get('/dashboard/user/query_section_id=2/request-to-edit-report/{id}', [ProtectionController::class, 'requestEditReport'])->name('protection.requestEditReport');
  //edit report page after allowing it
  Route::get('/dashboard/user/query_section_id=2/edit-report/{id}', [ProtectionController::class, 'editReport'])->name('protection.editReport');
  //submit edit report from engineers
  Route::post('/dashboard/user/query_section_id=2/edit-report/{id}', [ProtectionController::class, 'submitEditReport'])->name('proteciton.submitEditReport');
  //show user tasks page
  Route::get('/dashboard/user/query_section_id=2/engineer-tasks/{id}', [ProtectionController::class, 'showEngineerTasks'])->name('protection.showEngineerTasks');
  Route::get('/dashboard/user/query_section_id=2/engineer-tasks-uncompleted/{id}', [ProtectionController::class, 'showEngineerTasksUncompleted'])->name('protection.showEngineerTasksUncompleted');
  Route::get('/dashboard/user/query_section_id=2/engineer-tasks-completed/{id}', [ProtectionController::class, 'showEngineerTasksCompleted'])->name('protection.showEngineerTasksCompleted');
  //equip
  Route::get('/protection/Equip/{id}', [ProtectionController::class, 'getEquip']);
  Route::get('/protection/EquipNumber/{id}/{voltage_level}', [ProtectionController::class, 'getEquipNumber']);
  Route::get('/protection/Equipname/{station_id}/{voltage_level}/{equip_number}', [ProtectionController::class, 'getEquipName']);
  //duty report
});
// /#########ADMIN ROUTES ##################
Route::middleware(['is_admin', 'is_protection'])->group(function () {
  //main page
  Route::get('/dashboard/admin/query_section_id=2', [ProtectionController::class, 'index'])->name('dashboard.admin.protection');
  //show dashboard based on control name
  Route::get('/dashboard/admin/query_section_id=2/control/', [ProtectionController::class, 'indexControl'])->name('dashboardControl.admin.protection');

  //show engineers request to edit reports
  Route::get('/dashboard/admin/query_section_id=2/engineers-report-request', [ProtectionController::class, 'showEngineersReportRequest'])->name('protection.showEngineersReportRequest');
  //allow engineers to edit
  Route::get('/dashboard/admin/query_section_id=2/allow-engineers-report-request/{id}', [ProtectionController::class, 'allowEngineersReportRequest'])->name('protection.allowEngineersReportRequest');
  //add task
  Route::get('/dashboard/admin/query_section_id=2/add_task', [ProtectionController::class, 'add_task'])->name('protection.addTask');
  //add task to be assinged
  Route::get('/dashboard/admin/query_section_id=2/add_task_to_be_assigned', [ProtectionController::class, 'assign_task'])->name('protection.assign_task');
  //get  all engineer's name
  Route::get('/getEngineer/{area_id}/{shift_id}', [ProtectionController::class, 'getEngineerName'])->name('protection.getEngineer');
  //get an engineer's email
  Route::get('/getEngineersEmail/{id}', [ProtectionController::class, 'getEngineersEmail']);
  //get an engineer based on shift
  Route::get('/getEngineersOnShift/{area_id}/{shift_id}', [ProtectionController::class, 'getEngineersShift']);
  //get stations
  Route::get('/stations/{id}', [ProtectionController::class, 'getStations']);
  // Route::get('/protection/getUserEmail/{id}',[ProtectionController::class,'getUserEmail']);
  ///*****BACKEND ROUTE *********
  //change task section
  Route::get('/protection/change-section/{id}', [ProtectionController::class, 'changeSection'])->name('protection.changeSection');
  //change section page
  Route::get('/dashboard/admin/query_section_id=2/change-section-page/{id}', [ProtectionController::class, 'changeSectionView'])->name('protection.changeSectionView');
  Route::post('/protection/send_task', [ProtectionController::class, 'store'])->name('protection.store');
  Route::post('/protection/assignTasks', [ProtectionController::class, 'storeAssignTask'])->name('protection.store.assign_task');
  Route::get('/dashboard/admin/query_section_id=2/All-tasks', [ProtectionController::class, 'showAllTasks'])->name('protection.admin.showAllTasks');
  Route::get('/dashboard/admin/query_section_id=2/pending-tasks', [ProtectionController::class, 'showPendingTasks'])->name('protection.admin.pendingTasks');
  Route::get('/dashboard/admin/query_section_id=2/completed-tasks', [ProtectionController::class, 'showCompletedTasks'])->name('protection.admin.completedTasks');
  Route::get('/dashboard/admin/query_section_id=2/archive', [ProtectionController::class, 'showArchive'])->name('protection.admin.archive');
  Route::get('/dashboard/admin/query_section_id=2/task-details/{id}', [ProtectionController::class, 'taskDetails'])->name('protection.admin.taskDetails');
  Route::get('/dashboard/admin/query_section_id=2/engineers_list', [ProtectionController::class, 'showEngineers'])->name('protection.engineers');
  Route::get('/dashboard/admin/query_section_id=2/users_list', [ProtectionController::class, 'showUsers'])->name('protection.users');
  //add engineer
  Route::post('/dashboard/admin/query_section_id=2/add-engineer', [ProtectionController::class, 'addEngineer'])->name('protection.addEngineer');
  //update Engineer
  Route::get('/dashboard/admin/query_section_id=2/edit-engineer-details/{id}', [ProtectionController::class, 'editEngineer'])->name('protection.admin.editEngieer');
  Route::post('/dashboard/admin/query_section_id=2/update-engineer-details/{id}', [ProtectionController::class, 'updateEngineer'])->name('protection.admin.updateEngineer');
  //delete Engineer
  Route::delete('/dashboard/admin/query_section_id=2/Delete-engineer', [ProtectionController::class, 'deleteEngineer'])->name('protection.deleteEngineer');
  Route::get('/dashboard/admin/query_section_id=2/update-task/{id}', [ProtectionController::class, 'updateTask'])->name('protection.updateTask');
  Route::post('/dashboard/admin/query_section_id=2/update-task/{id}', [ProtectionController::class, 'update'])->name('protection.update');
  Route::delete('/dashboard/admin/query_section_id=2/deleteTask', [ProtectionController::class, 'destroyTask'])->name('protection.destroyTask');
  //attachments
  Route::post('delete_file', [ProtectionController::class, 'destroyAttachment'])->name('delete_file');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/admin/query_section_id=2/print-report/{id}', [ProtectionController::class, 'viewPrintReport'])->name('protection.veiwReport');
  Route::get('/dashboard/admin/query_section_id=2/print-common-report/{id}/{section_id}', [ProtectionController::class, 'viewCommonReport'])->name('protection.viewCommonReport');
  //cancel track task that send to others sections
  Route::get('/dashboard/admin/query_section_id=2/cancel-task-traking/{id}', [ProtectionController::class, 'cancelTaskTraking'])->name('protection.cancelTaskTraking');
  Route::get('/dashboard/admin/query_section_id=2/return-task/{id}', [ProtectionController::class, 'returnTask'])->name('protection.returnTask');
  //add a new user from dashboard
  Route::post('/dashboard/admin/query_section_id=2/add-new-user', [ProtectionController::class, 'newuser'])->name('protection.admin.newUser');
  Route::get('/dashboard/admin/query_section_id=2/edit-user-details/{id}', [ProtectionController::class, 'editUser'])->name('protection.admin.editUser');
  Route::post('/dashboard/admin/query_section_id=2/update-user-details/{id}', [ProtectionController::class, 'updateUser'])->name('protection.admin.updateUser');
  //search report between dates
  Route::get('/dashboard/admin/query_section_id=2/archive/search_between_Dates', [ProtectionController::class, 'stationsByDates'])->name('protection.staionsByDates');
  //General-Check-Page
  Route::get('/dashboard/admin/query_section_id=2/general-check', [GeneralCheckControllerProtection::class, 'generalCheckIndex'])->name('protection.generalCheckIndex');
  //send-General-check
  Route::get('/dashboard/admin/query_section_id=2/send-general-check', [GeneralCheckControllerProtection::class, 'sendGeneralCheck'])->name('protection.sendGeneralCheck');
  //get all engineers
  Route::get('/general-chack/get-all-engineers', [GeneralCheckControllerProtection::class, 'generalCheckgetEngineers'])->name('protection.generalCheckgetEngineers');
  //get engineer Email
  Route::get('/general-chack/get-engineer-email/{id}', [GeneralCheckControllerProtection::class, 'generalCheckGetEmail'])->name('protection.generalCheckGetEmail');
  //send general check task
  Route::post('/protection/general-check/send_task', [GeneralCheckControllerProtection::class, 'store'])->name('protection.generalCheck.store');
  //engineer  General check task Page
  Route::get('/dashboard/admin/query_section_id=2/general-check/engineer-report-page/{id}', [GeneralCheckControllerProtection::class, 'showEngineerTask'])->name('protection.generalCheck.showTask');
  //engineer post report
  Route::post('/protection/general-check/{id}', [GeneralCheckControllerProtection::class, 'submitReport'])->name('protection.generalCheck.submitReport');
  //show all gc tasks for a month
  Route::get('/dashboard/admin/query_section_id=2/gc_tasks/All-tasks', [GeneralCheckControllerProtection::class, 'gc_showAllTasks'])->name('protection.gc.showAllTasks');
  //show pending tasks
  Route::get('/dashboard/admin/query_section_id=2/gc_tasks/pending-tasks', [GeneralCheckControllerProtection::class, 'gc_pendingTasks'])->name('protection.gc.pendingTasks');
  //show completed tasks
  Route::get('/dashboard/admin/query_section_id=2/gc_tasks/completed-tasks', [GeneralCheckControllerProtection::class, 'gc_completedTasks'])->name('protection.gc.completedTasks');
  Route::get('/dashboard/admin/query_section_id=2/gc_tasks/print-report/{id}', [GeneralCheckControllerProtection::class, 'gc_viewPrintReport'])->name('protection.gc.veiwReport');
  Route::get('/dashboard/admin/query_section_id=2/duty-tasks', [ProtectionController::class, 'showDuty'])->name('protection.showDuty');
  Route::get('/dashboard/admin/query_section_id=2/add-relay-setting', [ProtectionController::class, 'addRealySetting'])->name('protection.addRealySetting');
  Route::post('/dashboard/admin/query_section_id=2/add-relay-setting', [\App\Http\Controllers\RelaySettignsController::class, 'store'])->name('protection.submitRS');
});

Route::get('/dashboard/admin/stations-list', [ProtectionController::class, 'showStations'])->name('stationsList')->middleware('auth');
Route::get('/getUserEmail/{id}', [ProtectionController::class, 'getUserEmail']);

//to register new users to protection
Route::get('/register/protection', [ProtectionController::class, 'registerPage'])->name('protection.registerPage');
Route::post('/register/protection/signup', [ProtectionController::class, 'register'])->name('protection.register');


Route::get('/profile', function () {
  //
})->middleware('auth');
require __DIR__ . '/auth.php';