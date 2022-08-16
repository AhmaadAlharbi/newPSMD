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

Route::middleware(['auth', 'is_battery'])->group(function () {
  Route::get('/dashboard/user/query_section_id=3', [BatteryController::class, 'userIndex'])->name('battery.user.homepage');
  //engineer report form
  Route::get('/dashboard/user/query_section_id=3/Engineer-report-form/{id}', [
    BatteryController::class,
    'engineerReportForm'
  ])->name('battery.engineerReportForm');
  Route::post('/battery/Egineer-report/{id}', [BatteryController::class, 'SubmitEngineerReport'])
    ->name('battery.SubmitEngineerReport');
  Route::post('/battery/Egineer-report/uncompleted/{id}', [BatteryController::class, 'engineerReportUnCompleted'])
    ->name('battery.engineerReportUnCompleted');
  Route::get('/dashboard/user/query_section_id=3/{id}', [BatteryController::class, 'engineerPageTasks'])->name('battery.engineerPageTask');
  Route::get('/dashboard/user/query_section_id=3/{id}/completed', [BatteryController::class, 'engineerPageTasksCompleted'])->name('battery.engineerPageTaskCompleted');
  Route::get('/dashboard/user/query_section_id=3/{id}/pending', [BatteryController::class, 'engineerPageTasksUnCompleted'])->name('battery.engineerPageTaskUncompleted');
  // Route::get('/dashboard/user/query_section_id=3/task-details/{id}',[BatteryController::class,'usertaskDetails'])->name('protecion.user.taskDetails');
  Route::get('/battery/View_file/{id}/{file_name}', [BatteryController::class, 'open_file'])->name('battery.view_file');
  Route::get('/battery/download/{id}/{file_name}', [BatteryController::class, 'get_file'])->name('battery.download_file');
  Route::get('/dashboard/user/query_section_id=3/print-report/{id}', [BatteryController::class, 'viewPrintReport'])->name('battery.user.veiwReport');
  Route::get('/dashboard/user/archive/query_section_id=3/', [BatteryController::class, 'userArchive'])->name('battery.user.archive');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/user/query_section_id=3/task-details/{id}', [BatteryController::class, 'taskDetails'])->name('battery.user.taskDetails');
  //request form engineer to edit his report
  Route::get('/dashboard/user/query_section_id=3/request-to-edit-report/{id}', [BatteryController::class, 'requestEditReport'])->name('battery.requestEditReport');
  //edit report page after allowing it
  Route::get('/dashboard/user/query_section_id=3/edit-report/{id}', [BatteryController::class, 'editReport'])->name('battery.editReport');
  //submit edit report from engineers
  Route::post('/dashboard/user/query_section_id=3/edit-report/{id}', [BatteryController::class, 'submitEditReport'])->name('battery.submitEditReport');
  //show user tasks page
  Route::get('/dashboard/user/query_section_id=3/engineer-tasks/{id}', [BatteryController::class, 'showEngineerTasks'])->name('battery.showEngineerTasks');
  Route::get('/dashboard/user/query_section_id=3/engineer-tasks-uncompleted/{id}', [BatteryController::class, 'showEngineerTasksUncompleted'])->name('battery.showEngineerTasksUncompleted');
  Route::get('/dashboard/user/query_section_id=3/engineer-tasks-completed/{id}', [BatteryController::class, 'showEngineerTasksCompleted'])->name('battery.showEngineerTasksCompleted');
});
Route::middleware(['is_admin', 'is_battery'])->group(function () {
  //main page
  Route::get('/dashboard/admin/query_section_id=3', [BatteryController::class, 'index'])->name('dashboard.admin.battery');
  //show engineers request to edit reports
  Route::get('/dashboard/admin/query_section_id=3/engineers-report-request', [BatteryController::class, 'showEngineersReportRequest'])->name('battery.showEngineersReportRequest');
  //allow engineers to edit
  Route::get('/dashboard/admin/query_section_id=3/allow-engineers-report-request/{id}', [BatteryController::class, 'allowEngineersReportRequest'])->name('battery.allowEngineersReportRequest');
  //add task
  Route::get('/dashboard/admin/query_section_id=3/add_task', [BatteryController::class, 'add_task'])->name('battery.addTask');
  //add task to be assinged
  Route::get('/dashboard/admin/query_section_id=3/add_task_to_be_assigned', [BatteryController::class, 'assign_task'])->name('battery.assign_task');
  //get  all engineer's name
  Route::get('battery/getEngineer/{area_id}/{shift_id}', [BatteryController::class, 'getEngineerName'])->name('battery.getEngineer');
  //get an engineer's email
  Route::get('battery/getEngineersEmail/{id}', [BatteryController::class, 'getEngineersEmail']);
  //get an engineer based on shift
  Route::get('battery/getEngineersOnShift/{area_id}/{shift_id}', [BatteryController::class, 'getEngineersShift']);
  //get stations
  Route::get('battery/stations/{id}', [BatteryController::class, 'getStations']);
  // Route::get('/battery/getUserEmail/{id}',[BatteryController::class,'getUserEmail']);
  ///*****BACKEND ROUTE *********
  //change task section
  Route::get('/battery/change-section/{id}', [BatteryController::class, 'changeSection'])->name('battery.changeSection');
  //change section page
  Route::get('/dashboard/admin/query_section_id=3/change-section-page/{id}', [BatteryController::class, 'changeSectionView'])->name('battery.changeSectionView');

  Route::post('/battery/send_task', [BatteryController::class, 'store'])->name('battery.store');
  Route::post('/battery/assignTasks', [BatteryController::class, 'storeAssignTask'])->name('battery.store.assign_task');
  Route::get('/dashboard/admin/query_section_id=3/All-tasks', [BatteryController::class, 'showAllTasks'])->name('battery.admin.showAllTasks');
  Route::get('/dashboard/admin/query_section_id=3/pending-tasks', [BatteryController::class, 'showPendingTasks'])->name('battery.admin.pendingTasks');
  Route::get('/dashboard/admin/query_section_id=3/completed-tasks', [BatteryController::class, 'showCompletedTasks'])->name('battery.admin.completedTasks');
  Route::get('/dashboard/admin/query_section_id=3/archive', [BatteryController::class, 'showArchive'])->name('battery.admin.archive');
  Route::get('/dashboard/admin/query_section_id=3/task-details/{id}', [BatteryController::class, 'taskDetails'])->name('battery.admin.taskDetails');
  Route::get('/dashboard/admin/query_section_id=3/engineers_list', [BatteryController::class, 'showEngineers'])->name('battery.engineers');
  Route::get('/dashboard/admin/query_section_id=3/users_list', [BatteryController::class, 'showUsers'])->name('battery.users');
  //add engineer
  Route::post('/dashboard/admin/query_section_id=3/add-engineer', [BatteryController::class, 'addEngineer'])->name('battery.addEngineer');
  //update Engineer
  Route::get('/dashboard/admin/query_section_id=3/edit-engineer-details/{id}', [BatteryController::class, 'editEngineer'])->name('battery.admin.editEngieer');
  Route::post('/dashboard/admin/query_section_id=3/update-engineer-details/{id}', [BatteryController::class, 'updateEngineer'])->name('battery.admin.updateEngineer');

  Route::get('/dashboard/admin/query_section_id=3/update-task/{id}', [BatteryController::class, 'updateTask'])->name('battery.updateTask');
  Route::post('/dashboard/admin/query_section_id=3/update-task/{id}', [BatteryController::class, 'update'])->name('battery.update');
  Route::delete('/dashboard/admin/query_section_id=3/deleteTask', [BatteryController::class, 'destroyTask'])->name('battery.destroyTask');
  //attachments
  Route::post('battery/delete_file', [BatteryController::class, 'destroyAttachment'])->name('battery.delete_file');
  // VIEW REPORT PRINT PAGE
  Route::get('/dashboard/admin/query_section_id=3/print-report/{id}', [BatteryController::class, 'viewPrintReport'])->name('battery.veiwReport');
  Route::get('/dashboard/admin/query_section_id=3/print-common-report/{id}/{section_id}', [BatteryController::class, 'viewCommonReport'])->name('battery.viewCommonReport');
  //cancel track task that send to others sections
  Route::get('/dashboard/admin/query_section_id=3/cancel-task-traking/{id}', [BatteryController::class, 'cancelTaskTraking'])->name('battery.cancelTaskTraking');
  Route::get('/dashboard/admin/query_section_id=2/return-task/{id}', [BatteryController::class, 'returnTask'])->name('battery.returnTask');

  //add a new user from dashboard
  Route::post('/dashboard/admin/query_section_id=3/add-new-user', [BatteryController::class, 'newuser'])->name('battery.admin.newUser');
  Route::get('/dashboard/admin/query_section_id=3/edit-user-details/{id}', [BatteryController::class, 'editUser'])->name('battery.admin.editUser');
  Route::post('/dashboard/admin/query_section_id=3/update-user-details/{id}', [BatteryController::class, 'updateUser'])->name('battery.admin.updateUser');
  //search between dates
  Route::get('/dashboard/admin/query_section_id=3/archive/search_between_Dates', [BatteryController::class, 'stationsByDates'])->name('battery.staionsByDates');
});

Route::get('/dashboard/admin/stations-list', [BatteryController::class, 'showStations'])->name('stationsList')->middleware('auth');
Route::get('/getUserEmail/{id}', [BatteryController::class, 'getUserEmail']);

//to register new users to battery
Route::get('/register/battery', [BatteryController::class, 'registerPage'])->name('battery.registerPage');
Route::post('/register/battery/signup', [BatteryController::class, 'register'])->name('battery.register');


Route::get('/profile', function () {
  //
})->middleware('auth');
require __DIR__ . '/auth.php';
