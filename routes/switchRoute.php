<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sections\SwitchGearController;


// /#########USER ROUTES ##################
// Route::get('/dashboard/user/query_section_id=6', function () {
//     return view('switch.user.dashboard');
// })->middleware(['auth','is_switch'])->name('dashboard.user.switch');

Route::middleware(['auth', 'is_switch'])->group(function () {
  Route::get('/dashboard/user/query_section_id=6', [SwitchGearController::class, 'userIndex'])->name('switch.user.homepage');
  //engineer report form
  Route::get('/dashboard/user/query_section_id=6/Engineer-report-form/{id}', [
    SwitchGearController::class,
    'engineerReportForm'
  ])->name('switch.engineerReportForm');
  Route::post('/switch/Egineer-report/{id}', [SwitchGearController::class, 'SubmitEngineerReport'])
    ->name('switch.SubmitEngineerReport');
  Route::post('/switch/Egineer-report/uncompleted/{id}', [SwitchGearController::class, 'engineerReportUnCompleted'])
    ->name('switch.engineerReportUnCompleted');
  Route::get('/dashboard/user/query_section_id=6/{id}', [SwitchGearController::class, 'engineerPageTasks'])->name('switch.engineerPageTask');
  Route::get('/dashboard/user/query_section_id=6/{id}/completed', [SwitchGearController::class, 'engineerPageTasksCompleted'])->name('switch.engineerPageTaskCompleted');
  Route::get('/dashboard/user/query_section_id=6/{id}/pending', [SwitchGearController::class, 'engineerPageTasksUnCompleted'])->name('switch.engineerPageTaskUncompleted');
  Route::get('/dashboard/user/query_section_id=6/task-details/{id}', [SwitchGearController::class, 'usertaskDetails'])->name('switch.user.taskDetails');
  Route::get('switchgear/View_file/{id}/{file_name}', [SwitchGearController::class, 'open_file'])->name('switch.view_file');
  Route::get('switchgear/download/{id}/{file_name}', [SwitchGearController::class, 'get_file'])->name('switch.download_file');
  Route::get('/dashboard/user/query_section_id=6/print-report/{id}', [SwitchGearController::class, 'viewPrintReport'])->name('switch.user.veiwReport');
  Route::get('/dashboard/user/archive/query_section_id=6/', [SwitchGearController::class, 'userArchive'])->name('switch.user.archive');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/user/query_section_id=6/request-to-edit-report/{id}', [SwitchGearController::class, 'requestEditReport'])->name('switch.requestEditReport');
  //edit report page after allowing it
  Route::get('/dashboard/user/query_section_id=6/edit-report/{id}', [SwitchGearController::class, 'editReport'])->name('switch.editReport');
  //submit edit report from engineers
  Route::post('/dashboard/user/query_section_id=6/edit-report/{id}', [SwitchGearController::class, 'submitEditReport'])->name('switch.submitEditReport');
  //show user tasks page
  Route::get('/dashboard/user/query_section_id=6/engineer-tasks/{id}', [SwitchGearController::class, 'showEngineerTasks'])->name('switch.showEngineerTasks');
  Route::get('/dashboard/user/query_section_id=6/engineer-tasks-uncompleted/{id}', [SwitchGearController::class, 'showEngineerTasksUncompleted'])->name('switch.showEngineerTasksUncompleted');
  Route::get('/dashboard/user/query_section_id=6/engineer-tasks-completed/{id}', [SwitchGearController::class, 'showEngineerTasksCompleted'])->name('switch.showEngineerTasksCompleted');
  //add a new user from dashboard
  Route::post('/dashboard/admin/query_section_id=6/add-new-user', [SwitchGearController::class, 'newuser'])->name('switch.admin.newUser');
});

// /#########ADMIN ROUTES ##################

Route::middleware(['is_admin', 'is_switch'])->group(function () {
  //change section page
  Route::get('/dashboard/admin/query_section_id=6/change-section-page/{id}', [SwitchGearController::class, 'changeSectionView'])->name('switch.changeSectionView');
  //change task section
  Route::get('/switch/change-section/{id}', [SwitchGearController::class, 'changeSection'])->name('switch.changeSection');
  //main page
  Route::get('/dashboard/admin/query_section_id=6', [SwitchGearController::class, 'index'])->name('dashboard.admin.switch');
  //show engineers request to edit reports
  Route::get('/dashboard/admin/query_section_id=6/engineers-report-request', [SwitchGearController::class, 'showEngineersReportRequest'])->name('switch.showEngineersReportRequest');
  //allow engineers to edit
  Route::get('/dashboard/admin/query_section_id=6/allow-engineers-report-request/{id}', [SwitchGearController::class, 'allowEngineersReportRequest'])->name('switch.allowEngineersReportRequest');
  //add task
  Route::get('/dashboard/admin/query_section_id=6/add_task', [SwitchGearController::class, 'add_task'])->name('switch.addTask');
  //add task to be assinged
  Route::get('/dashboard/admin/query_section_id=6/add_task_to_be_assigned', [SwitchGearController::class, 'assign_task'])->name('switch.assign_task');
  //get  all engineer's name
  Route::get('/switchgear/getEngineer/{area_id}/{shift_id}', [SwitchGearController::class, 'getEngineerName'])->name('switch.getEngineer');

  //get an engineer's email
  Route::get('/switchgear/getEngineersEmail/{id}', [SwitchGearController::class, 'getEngineersEmail']);
  //get an engineer based on shift
  Route::get('/switchgear/getEngineersOnShift', [SwitchGearController::class, 'getEngineersShift']);
  //get stations
  Route::get('/switchgear/stations/{id}', [SwitchGearController::class, 'getStations']);

  ///BACKEND ROUTE
  Route::post('/switch/send_task', [SwitchGearController::class, 'store'])->name('switch.store');
  Route::post('/switch/assignTasks', [SwitchGearController::class, 'storeAssignTask'])->name('switch.store.assign_task');
  Route::get('/dashboard/admin/query_section_id=6/All-tasks', [SwitchGearController::class, 'showAllTasks'])->name('switch.admin.showAllTasks');
  Route::get('/dashboard/admin/query_section_id=6/pending-tasks', [SwitchGearController::class, 'showPendingTasks'])->name('switch.admin.pendingTasks');
  Route::get('/dashboard/admin/query_section_id=6/completed-tasks', [SwitchGearController::class, 'showCompletedTasks'])->name('switch.admin.completedTasks');
  Route::get('/dashboard/admin/query_section_id=6/archive', [SwitchGearController::class, 'showArchive'])->name('switch.admin.archive');
  Route::get('/dashboard/admin/query_section_id=6/task-details/{id}', [SwitchGearController::class, 'taskDetails'])->name('switch.admin.taskDetails');
  Route::get('/dashboard/admin/query_section_id=6/engineers_list', [SwitchGearController::class, 'showEngineers'])->name('switch.engineers');
  //add engineer
  Route::post('/dashboard/admin/query_section_id=6/add-engineer', [SwitchGearController::class, 'addEngineer'])->name('switch.addEngineer');
  //update Engineer
  Route::get('/dashboard/admin/query_section_id=6/edit-engineer-details/{id}', [SwitchGearController::class, 'editEngineer'])->name('switch.admin.editEngieer');
  Route::post('/dashboard/admin/query_section_id=6/update-engineer-details/{id}', [SwitchGearController::class, 'updateEngineer'])->name('switch.admin.updateEngineer');
  Route::get('/dashboard/admin/query_section_id=6/users_list', [SwitchGearController::class, 'showUsers'])->name('switch.users');
  Route::get('/dashboard/admin/query_section_id=6/update-task/{id}', [SwitchGearController::class, 'updateTask'])->name('switch.updateTask');
  Route::post('/dashboard/admin/query_section_id=6/update-task/{id}', [SwitchGearController::class, 'update'])->name('switch.update');
  Route::delete('/dashboard/admin/query_section_id=6/deleteTask', [SwitchGearController::class, 'destroyTask'])->name('switch.destroyTask');
  //attachments
  Route::post('delete_file/switchgear', [SwitchGearController::class, 'destroyAttachment'])->name('switch.delete_file');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/admin/query_section_id=6/print-report/{id}', [SwitchGearController::class, 'viewPrintReport'])->name('switch.veiwReport');
  Route::get('/dashboard/admin/query_section_id=6/print-common-report/{id}/{section_id}', [SwitchGearController::class, 'viewCommonReport'])->name('switch.viewCommonReport');
  //cancel track task that send to others sections
  Route::get('/dashboard/admin/query_section_id=6/cancel-task-traking/{id}', [SwitchGearController::class, 'cancelTaskTraking'])->name('switch.cancelTaskTraking');
  Route::get('/dashboard/admin/query_section_id=2/return-task/{id}', [SwitchGearController::class, 'returnTask'])->name('switch.returnTask');

  Route::get('/dashboard/admin/query_section_id=6/edit-user-details/{id}', [SwitchGearController::class, 'editUser'])->name('switch.admin.editUser');
  Route::post('/dashboard/admin/query_section_id=6/update-edit-user-details/{id}', [SwitchGearController::class, 'updateUser'])->name('switch.admin.updateUser');
});

Route::get('/dashboard/admin/stations-list', [SwitchGearController::class, 'showStations'])->name('stationsList')->middleware('auth');

//to register new users to protection
Route::get('/register/switchgear', [SwitchGearController::class, 'registerPage'])->name('switch.registerPage');
Route::post('/register/switchgear/signup', [SwitchGearController::class, 'register'])->name('switch.register');
require __DIR__ . '/auth.php';