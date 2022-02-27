<?php

namespace App\Http\Controllers\sections;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Engineer;
use App\Models\Station;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\TaskDetails;
use App\Models\TaskAttachment;
use Illuminate\Support\Facades\Notification;
use  App\Notifications\EditTask;
use  App\Notifications\AddTask;
use  App\Notifications\AddTaskWithAttachments;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Gate;

class ProtectionController extends Controller
{
    ####################### ADMIN CONTROLLER ########################

    public function index(){
        $tasks = Task::orderBy('id', 'desc')
            ->where('fromSection',2)
            ->where('status', 'pending')
            ->get();
        // $task_details = TaskDetails::orderBy('id', 'desc')
        // ->where('status', 'completed')
        // ->whereMonth('created_at', date('m'))
        // ->paginate(4);

        $task_details = DB::table('task_details')
        ->join('tasks','tasks.id','=','task_details.task_id')
        ->where('task_details.status','completed')
        ->where('tasks.fromSection',2)
        ->orderBy('tasks.id', 'desc')

        ->get();   
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('protection.admin.dashboard',compact('tasks','task_details','date','monthName'));


    }
    //// start front END functions
    public function add_task(){
        $stations = Station::all();
        return view ('protection.admin.tasks.add_task',compact('stations'));
    }
    //get all Engineer  JSON
    public function getEngineerName($area_id,$shift_id){
        return (String) DB::table('engineers')
        ->where('area',$area_id)
        ->where('shift',$shift_id)
        ->Join('users','users.id','=','engineers.user_id')
        ->where('users.section_id',2)
        ->get();
    }
    //get user email
    public function getUserEmail($user_name){
        return (String) User::where('name',$user_name)->first();
    }
    //get Engineer Email
    public function getEngineersEmail($user_id){
        return (String) $engineersTable = DB::table('engineers')
        ->where("user_id",$user_id)
        ->join('users','users.id','=','engineers.user_id')
        ->select('users.name','users.id','users.email','users.section_id')
        ->get();   
    }
    
    //get Engineers based on shift
    public function getEngineersShift($area_id,$shift_id){
        return (String) $engineersTable = DB::table('engineers')
        ->where("area",$area_id)
        ->where("shift",$shift_id)
        ->join('users','users.id','=','engineers.user_id')
        ->select('users.name','users.id','users.email','users.section_id')
        ->where('users.section_id',2)
        ->get();  
    }

    //get station
    public function getStations($SSNAME){
        return (string) Station::where("SSNAME",$SSNAME)
        ->first(); 
    }
    //// end of frontend functions
    ///#####start backend functions

    public function store(Request $request){ 

        Task::create([
            'refNum' => $request->refNum,
            'fromSection'=>2,
            'station_id'=>$request->ssnameID,
            'main_alarm'=>$request->mainAlarm,
            'voltage_level'=>$request->voltage_level,
            'work_type'=>$request->work_type,
            'task_date'=>$request->task_Date,
            'equip'=>$request->equip,
            'pm'=>$request->pm,
            'eng_id'=>$request->eng_name,
            'problem' => $request->problem,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
        $task_id = Task::latest()->first()->id;
        $engineer_email = $request->eng_email;
        
        TaskDetails::create([
            'task_id'=>$task_id,
            'eng_id'=>$request->eng_name,
            'status'=>'pending',
        ]);

        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/protection/' . $task_id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new TaskAttachment();
                $attachments->file_name = $name;
                $attachments->created_by = Auth::user()->name;
                $attachments->id_task = $task_id;
                $attachments->save();
            }
            //to send email
            Notification::route('mail', $engineer_email)
                ->notify(new AddTaskWithAttachments($task_id, $data, $request->station_code));
        }else{
            Notification::route('mail', $engineer_email)
            ->notify(new AddTask($task_id, $request->station_code));
        }


            
        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();

    }

    public function showEngineersReportRequest(){
        $tasks = Task::where('report_status',2)->get();
        return view('protection.admin.tasks.engineersReportRequest',compact('tasks'));
    }
    public function showAllTasks(){
        $tasks = Task::where('fromSection',2)->orderBy('id', 'desc')
        ->get();
        return view('protection.admin.tasks.showTasks',compact('tasks'));
    }

    public function showPendingTasks(){
        $tasks = Task::where('fromSection',2)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('protection.admin.tasks.showTasks',compact('tasks'));  
    }

    public function showCompletedTasks(){
        $tasks = Task::where('fromSection',2)
        ->where('status','completed')
        ->whereMonth('created_at', date('m'))
        ->orderBy('id', 'desc')
        ->get();
        return view('protection.admin.tasks.showTasks',compact('tasks'));
    }
    public function showArchive(){
        $tasks = Task::where('fromSection',2)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('protection.admin.tasks.showTasks',compact('tasks'));
    }

    public function userArchive(){
        $tasks = Task::where('fromSection',2)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('protection.user.tasks.showTasks',compact('tasks'));
    }
   
    public function taskDetails($id){
        $tasks = Task::where('id',$id)->get();
        $task_details = TaskDetails::where('task_id',$id)->get();
        $task_attachment = TaskAttachment::where('id_task',$id)->get();
        return view('protection.admin.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }

    public function showEngineers(){
        // $engineers = Engineer::where('section_id',2)->get();
        // return view ('protection.admin.engineers.engineersList',compact('engineers'));

        $engineers = DB::table('engineers')
        ->join('users','users.id','=','engineers.user_id')
        ->select('users.name','users.id','users.email','users.section_id','engineers.area','engineers.shift')
        ->where('users.section_id',2)
        ->get();
        $users = User::where('section_id',2)->get();   
         return view ('protection.admin.engineers.engineersList',compact('engineers','users'));

    }
    public function addEngineer(Request $request){
        Engineer::create([
            'user_id'=>$request->user_id,
            'section_id'=>2,
            'area'=>$request->area_id,
            'shift'=>$request->shift_id,
        ]);
        session()->flash('Add','تم الاضافة بنجاح');
        return back();
    }

    //get 
    public function updateTask($id){
        $tasks = Task::where('id',$id)->first();
        $stations = Station::all();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
       
        return view('protection.admin.tasks.updateTask',compact('tasks','stations','task_attachments'));
    }

//post
    public function update(Request $request , $id){
        $tasks = Task::findOrFail($id);
        $tasks->update([
            'refNum' => $request->refNum,
            'fromSection'=>2,
            'station_id'=>$request->ssnameID,
            'main_alarm'=>$request->mainAlarm,
            'voltage_level'=>$request->voltage_level,
            'work_type'=>$request->work_type,
            'task_date'=>$request->task_Date,
            'equip'=>$request->equip,
            'eng_id'=>$request->eng_name,
            'problem' => $request->problem,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
        $task_id = $id;
        $engineer_email = $request->eng_email;
        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/protection/' . $task_id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new TaskAttachment();
                $attachments->file_name = $name;
                $attachments->created_by = Auth::user()->name;
                $attachments->id_task = $task_id;
                $attachments->save();
            }
            //to send email
            Notification::route('mail', $engineer_email)
                ->notify(new AddTaskWithAttachments($task_id, $data, $request->station_code));
        }else{
            Notification::route('mail', $engineer_email)
            ->notify(new EditTask($task_id, $request->station_code));
        }
       
        session()->flash('edit', 'تم   التعديل  بنجاح');
        return back();
    }

    public function destroyTask(Request $request)
    {
        $id = $request->invoice_id;
        $tasks = Task::where('id', $id)->first();
        $tasks->delete();
        return back();
    }
  public function open_file($id, $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('protection/'.$id . '/' . $file_name);
        return response()->file($files);
    }
    public function get_file($id, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('protection/'.$id . '/' . $file_name);
        return response()->download($contents);
    }
    public function destroyAttachment(Request $request)
    {
        $task_attachment = TaskAttachment::findOrFail($request->id_file);
        $task_attachment->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
    public function viewPrintReport($id){
        $task_details = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->first();
        return view('protection.admin.tasks.report',compact('task_details'));
    }
    
    ///##### end backend functions

        ####################### USER CONTROLLER ########################
    
    public function userIndex() {
        $tasks = Task::orderBy('id', 'desc')
        ->where('fromSection',2)
        ->where('eng_id',Auth::user()->id)
        ->where('status', 'pending')
        ->get();


        $task_details = DB::table('task_details')
        ->join('tasks','tasks.id','=','task_details.task_id')
        ->where('task_details.status','completed')
        ->where('tasks.fromSection',2)
        ->orderBy('tasks.id', 'desc')

        ->get();   
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('protection.user.dashboard',compact('tasks','task_details','date','monthName'));
    }

    // public function engineerPageTasks($id){
    //     $engineer = Engineer::where('email',$id)->value('id');
    //     $tasks = Task::where('eng_id',$engineer)
    //         ->orderBy('id', 'desc')
    //         ->get();
        
    //     return view('protection.user.mytasks', compact('tasks'));
    // }
    public function showEngineerTasks($id){
        $tasks = Task::where('eng_id',$id)
            ->orderBy('id', 'desc')
            ->get();
  
        return view('protection.user.tasks.engineerTasks', compact('tasks'));
    }
    public function showEngineerTasksUncompleted($id){
        $tasks = Task::where('eng_id',$id)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('protection.user.tasks.engineertasks', compact('tasks'));
    }
    public function showEngineerTasksCompleted($id){
        $tasks = Task::where('eng_id',$id)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        // $tasks_details = TaskDetails::where('eng_id',$id)
        // ->where('status','completed')
        // ->get();
        return view('protection.user.tasks.engineertasks', compact('tasks'));
    }
    public function usertaskDetails($id){
        $tasks = Task::where('id', $id)->first();
        $task_details = TaskDetails::where('task_id', $id)->get();
        $task_attachment = TaskAttachment::where('id_task', $id)->get();
        return view('protection.user.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }
    public function engineerPageTasksCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','completed')
            ->get();
        return view('protection.user.mytasks', compact('tasks'));
    }
    public function engineerPageTasksUnCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','pending')
            ->get();
        return view('protection.user.mytasks', compact('tasks'));
    }
    public function engineerReportForm($id,Request $request , Task $task){
        $tasks = Task::where('id',$id)->first();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
           if (!Gate::allows('write-report',$tasks)) {
            abort(403);    
        }
        return view('protection.user.EngineerReportForm',compact('tasks','task_attachments'));
    }

    public function SubmitEngineerReport(Request $request,$id){
        $task= Task::findOrFail($id);
        echo $engineerEmail = Auth::user()->email ;
        $eng_id = User::where('email',$engineerEmail)->pluck('id')->first();
        TaskDetails::create([
            'task_id' => $id,
            'report_date' => Carbon::now(),
            'eng_id' =>$eng_id,
            'action_take' => $request->action_take,
            'report_status'=>1,
            'status'=>'completed',
        ]);
        $task->update([
            'status'=>'completed',
        ]);
        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/protection/' . $id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new TaskAttachment();
                $attachments->file_name = $name;
                $attachments->created_by = Auth::user()->name;
                $attachments->id_task = $id;
                $attachments->save();
            }
          
        }
        session()->flash('Add', 'تم اضافة التقرير بنجاح');
        return back();
        
    }

    public function engineerReportUnCompleted(Request $request,$id){
        $task= Task::findOrFail($id);
        $engineerEmail = Auth::user()->email ;
        $eng_id = Engineer::where('email',$engineerEmail)->pluck('id')->first();
        //if task Completed
        if ($request->reason === 'مسؤولية جهة آخرى' || $request->reason === "تحت الكفالة") {
            $task->update([
                'status' =>'completed',
            ]);
            TaskDetails::create([
                'task_id'=>$id,
                'fromSection'=>2,
                'report_date'=>Carbon::now(),
                'reasonOfUncompleted'=>$request->reason,
                'eng_id' =>$eng_id,
                'engineer_notes'=>$request->engineer_note,
                'status'=>'completed'
            ]);
        }else{
            $task->update([
                'status' =>'pending',
            ]);
            TaskDetails::create([
                'task_id'=>$id,
                'fromSection'=>2,
                'report_date'=>Carbon::now(),
                'reasonOfUncompleted'=>$request->reason,
                'eng_id' =>$eng_id,
                'engineer_notes'=>$request->engineer_note,
                'status'=>'pending'
            ]);

         
        }
        session()->flash('Add', 'تم اضافة التقرير بنجاح');
        return back();
       

    }

    public function requestEditReport($id){
        $task = Task::where('id',$id)
        ->where('status','completed')
        ->first();
        $task->update([
            'report_status'=>2,
        ]);
        return back();
    }

    public function allowEngineersReportRequest($id){
        $task = Task::where('id',$id)
        ->where('status','completed')
        ->first();
        $task->update([
            'report_status'=>0,
        ]);
        return back();
    }
    //edit report from engineers
    public function editReport($id){
        $tasks = Task::where('id',$id)
        ->where('status','completed')
        ->first();
        $tasks_details = TaskDetails::where('task_id',$id)->where('status','completed')->first();
        $task_attachments =TaskAttachment::where('id_task',$id)->get();
        return view('protection.user.tasks.editReport',compact('tasks','tasks_details','task_attachments'));
    }

    public function submitEditReport($id,Request $request){
        $tasks = Task::where('id',$id)->first();
        $tasks_details = TaskDetails::where('task_id',$id)->where('status','completed')->first();

        $tasks->update([
            'report_status'=>1,
        ]);
        $tasks_details->update([
            'action_take'=>$request->action_take,
        ]);
        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file){
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/protection/' . $id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new TaskAttachment();
                $attachments->file_name = $name;
                $attachments->created_by = Auth::user()->name;
                $attachments->id_task = $id;
                $attachments->save();
            }
        }

        session()->flash('Add', 'تم التعديل بنجاح');
        return back();

    }

    //this is public route
    public function showStations(){
        $stations = Station::all();
        return view ('stations.stationsList',compact('stations'));
    }

   

}