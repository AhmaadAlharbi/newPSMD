<?php
namespace App\Http\Controllers\sections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Engineer;
use App\Models\User;
use App\Models\Station;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\TaskDetails;
use App\Models\TaskAttachment;
use App\Models\TR;
use Illuminate\Support\Facades\Notification;
use  App\Notifications\EditTask;
use  App\Notifications\AddTask;
use  App\Notifications\AddTaskWithAttachments;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
class TransformersController extends Controller
{
       ###################### ADMIN CONTROLLER ########################
    public function index(){
        $tasks = Task::orderBy('id', 'desc')
            ->where('status', 'pending')
            ->where('fromSection',5)
            ->get();
            $task_details = TaskDetails::orderBy('id', 'desc')
            ->where('status', 'completed')
            ->whereMonth('created_at', date('m'))
            ->where('fromSection',5)
           ->paginate(5);
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('transformers.admin.dashboard',compact('tasks','task_details','date','monthName'));

    }
     //// start front END functions
     public function add_task(){
        $stations = Station::all();
        return view ('transformers.admin.tasks.add_task',compact('stations'));
    }
       //get all Engineer  JSON
       public function getEngineerName($area_id,$shift_id){
        return (string) Engineer::orderBy('name')
        ->where("section_id",5)
        ->where('area',$area_id)
        ->where('shift',$shift_id)
        ->get();
    }
    //get Engineer Email
    public function getEngineersEmail($eng_id){
        return (string) Engineer::where("section_id",5)
        ->where('id',$eng_id)
        ->first();
    }
    //get Engineers based on shift
    public function getEngineersShift($area_id,$shift_id){
        return (string) Engineer::where("section_id",5)
        ->where('area',$area_id)
        ->where('shift',$shift_id)
        ->get();
    }

    //get station
    public function getStations($SSNAME){
        return (string) Station::where("SSNAME",$SSNAME)
        ->first(); 
    }
    //
    public function getAdmins($area,$department){
       return (String) $tr = DB::table('tr')
        ->where("area",$area)
        ->where('department',$department)
        ->orWhere('area',0)->where('department',$department)

        ->join('users','users.id','=','tr.user_id')
        ->select('users.name','users.id','users.email')
        ->get();     
    }   


    //end of frontend
      ///#####start backend functions

      public function store(Request $request){ 
        $validated = $request->validate([
            'ssnameID' => 'required|numeric',

        ],
        [
            'ssnameID.required' =>'يرجى اختيار المحطة من القائمة فقط',
            'ssnameID.numeric'=>'يرجى اختيار المحطة من القائمة فقط'

        ]);
        Task::create([
            'refNum' => $request->refNum,
            'fromSection'=>5,
            'station_id'=>$request->ssnameID,
            'main_alarm'=>$request->mainAlarm,
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
            'fromSection'=>5,
            'eng_id'=>$request->eng_name,
            'status'=>'pending',
        ]);

        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/battery/' . $task_id), $name);
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
                ->notify(new AddTaskWithAttachments($task_id, $data, $request->ssname));
        }else{
            Notification::route('mail', $engineer_email)
            ->notify(new AddTask($task_id, $request->ssname));
        }
        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();

    }
    public function showAllTasks(){
        $tasks = Task::where('fromSection',5)->orderBy('id', 'desc')
        ->get();
        return view('battery.admin.tasks.showTasks',compact('tasks'));
    }

    public function showPendingTasks(){
        $tasks = Task::where('fromSection',5)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('battery.admin.tasks.showTasks',compact('tasks'));  
    }

    public function showCompletedTasks(){
        $tasks = Task::where('fromSection',5)
        ->where('status','completed')
        ->whereMonth('created_at', date('m'))
        ->orderBy('id', 'desc')
        ->get();
        return view('battery.admin.tasks.showTasks',compact('tasks'));
    }
    public function showArchive(){
        $tasks = Task::where('fromSection',5)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('battery.admin.tasks.showTasks',compact('tasks'));
    }

    public function userArchive(){
        $tasks = Task::where('fromSection',5)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('battery.user.tasks.showTasks',compact('tasks'));
    }
   
    public function taskDetails($id){
        $tasks = Task::where('id',$id)->get();
        $task_details = TaskDetails::where('task_id',$id)->get();
        $task_attachment = TaskAttachment::where('id_task',$id)->get();
        return view('battery.admin.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }

    public function showEngineers(){
        $engineers = Engineer::where('section_id',5)->get();
        return view ('battery.admin.engineers.engineersList',compact('engineers'));
    }

    //get 
    public function updateTask($id){
        $tasks = Task::where('id',$id)->first();
        $stations = Station::all();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
       
        return view('battery.admin.tasks.updateTask',compact('tasks','stations','task_attachments'));
    }

//post
    public function update(Request $request , $id){
        $tasks = Task::findOrFail($id);
        $tasks->update([
            'refNum' => $request->refNum,
            'fromSection'=>5,
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
                $file->move(public_path('Attachments/battery/' . $task_id), $name);
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
                ->notify(new AddTaskWithAttachments($task_id, $data, $request->ssname));
        }else{
            Notification::route('mail', $engineer_email)
            ->notify(new EditTask($task_id, $request->ssname));
        }
       
        session()->flash('edit', 'تم   التعديل  بنجاح');
        return back();
    }

    public function destroyTask(Request $request){
        $id = $request->invoice_id;
        $tasks = Task::where('id', $id)->first();
        $tasks->delete();
        return back();
    }
    public function open_file($id, $file_name){
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('battery/'.$id . '/' . $file_name);
        return response()->file($files);
    }
    public function get_file($id, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('battery/'.$id . '/' . $file_name);
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
        return view('battery.admin.tasks.report',compact('task_details'));
    }
    public function addEngineer(Request $request){
        Engineer::create([
            'name'=>$request->eng_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'section_id'=> 5,
            'area'=>1   ,
            'shift'=>0,

        ]);
        session()->flash('Add','تم الاضافة بنجاح');
        return back();
    }
     ///##### end backend functions

        ####################### USER CONTROLLER ########################
    
    public function userIndex() {
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Station::orderBy('SSNAME')->get();
        $tasks = Task::orderBy('id', 'desc')
        ->where('status', 'pending')
        ->where('fromSection',5)
        ->where('eng_id',Engineer::where('email',Auth::user()->email)->value('id'))
        ->get();
        $task_details = TaskDetails::orderBy('id', 'desc')
        ->where('status', 'completed')
        ->whereMonth('created_at', date('m'))
        ->where('fromSection',5)

        ->paginate(5);
        $date = Carbon::now();
        return view('battery.user.dashboard',compact('tasks','task_details','date','engineers','stations'));
    }

    public function engineerPageTasks($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->get();
        return view('battery.user.mytasks', compact('tasks'));
    }
    public function usertaskDetails($id){
        $tasks = Task::where('id', $id)->first();
        $task_details = TaskDetails::where('task_id', $id)->get();
        $task_attachment = TaskAttachment::where('id_task', $id)->get();
        return view('battery.user.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }
    public function engineerPageTasksCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','completed')
            ->get();
        return view('battery.user.mytasks', compact('tasks'));
    }
    public function engineerPageTasksUnCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','pending')
            ->get();
        return view('battery.user.mytasks', compact('tasks'));
    }
    public function engineerReportForm($id){
        $tasks = Task::where('id',$id)->first();
        return view('battery.user.EngineerReportForm',compact('tasks'));
    }

    public function SubmitEngineerReport(Request $request,$id){
        $task= Task::findOrFail($id);
        TaskDetails::create([
            'task_id' => $id,
            'fromSection'=>5,
            'report_date' => Carbon::now(),
            'eng_id' =>(Auth::user()->id),
            'action_take' => $request->action_take,
            'status'=>'completed',
        ]);
        $task->update([
            'status'=>'completed',
        ]);
        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/battery/' . $id), $name);
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
                'fromSection'=>5,
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
                'fromSection'=>5,
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

    //this is public route
    public function showStations(){
        $stations = Station::all();
        return view ('stations.stationsList',compact('stations'));
    }


}