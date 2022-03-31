<?php
namespace App\Http\Controllers\sections;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Engineer;
use App\Models\Station;
use App\Models\Section;
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
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;
class SwitchGearController extends Controller
{
    ####################### ADMIN CONTROLLER ########################
  //register new  page
  public function registerPage(){
    return view('switchgear.admin.register');
}
//sign up users
public function register(Request $request){
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'section_id'=>6,
        'password' => Hash::make($request->password),
        'is_admin'=>0,
    ]);
    event(new Registered($user));
    Auth::login($user);

    return redirect(RouteServiceProvider::SwitchGearHomeUser);

}
    public function index(){
        $tasks = Task::orderBy('id', 'desc')
        ->where('fromSection',6)
        ->whereNull('toSection')
        ->where('status', 'pending')
        ->orWhere('toSection',6)
        ->whereNull('fromSection')
        ->where('status', 'pending')
        ->get();
        
        $incomingTasks = Task::Where('toSection',6)
        ->whereNotNull('fromSection')
        ->where('status', 'pending')
        ->get();
        $task_details= TaskDetails::where('section_id',6)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
     //to track mutal tasks in diffrent sections  
     $common_tasks_details = Task::where('fromSection',6)
     ->whereNotNull('toSection')
     ->get();
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('switchgear.admin.dashboard',compact('tasks','task_details','date','monthName','common_tasks_details','incomingTasks'));


    }
    //// start front END functions
    public function add_task(){
        if(isset(Task::latest()->first()->id)){
            $task_id = Task::latest()->first()->id;
            $task_id++;
        }else{
            $task_id = 1;
        }
        $stations = Station::all();
        return view ('switchgear.admin.tasks.add_task',compact('stations','task_id'));
    }
    public function addEngineer(Request $request){
        Engineer::create([
            'user_id'=>$request->user_id,
            'section_id'=>6,
            'area'=>$request->area_id,
            'shift'=>$request->shift_id,
        ]);
        session()->flash('Add','تم الاضافة بنجاح');
        return back();
    }

     //change section view
     public function changeSectionView($id){
        $tasks = Task::where('id',$id)->first();
        $stations = Station::all();
        $sections = Section::all();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();

        return view('switchgear.admin.tasks.changeSection',compact('tasks','stations','task_attachments','sections'));

    }

    //change section
    public function changeSection($id,Request $request){
        $tasks = Task::where('id',$id)->first();
        $tasks_details = TaskDetails::where('task_id',$id)->first();
        $date = Carbon::now();
        $fromSection = $tasks->fromSection;
        if($fromSection !== 1){
            $fromSection =6;
        }
        $tasks->update([
            'fromSection'=>$fromSection,
            'toSection'=> $request->section_id,
            'eng_id'=> null,
            'status'=>'pending',
        ]);
        $tasks_details->create([
            'task_id'=> $id,
            'fromSection'=>6,
            'toSection'=>$request->section_id,
            'eng_id'=>null,
            'report_date'=>$date,
            'status' => 'change',
        ]);
        return back();
    }

        //cancel task tracking
        public function cancelTaskTraking($id){
            $tasks = Task::findOrFail($id);
            $tasks->update([
                'fromSection'=> null,
            ]);
            return back();
        }
        //assign task page
        public function assign_task(){
            if(isset(Task::latest()->first()->id)){
                $task_id = Task::latest()->first()->id;
                $task_id++;
            }else{
                $task_id = 1;
            }
            $stations = Station::all();
            return view ('switchgear.admin.tasks.assign_task',compact('stations','task_id'));
        }
    //get all Engineer  JSON
    public function getEngineerName($area_id,$shift_id){
        // return (String) $engineersTable = DB::table('engineers')
        // ->where("area",$area_id)
        // ->where("shift",$shift_id)
        // ->join('users','users.id','=','engineers.user_id')
        // ->where('users.section_id',6)
        // ->get();  
        return (String) DB::table('engineers')
        ->where('area',$area_id)
        ->where('shift',$shift_id)
        ->Join('users','users.id','=','engineers.user_id')
        ->where('users.section_id',6)
        ->get();
    }
    //store assign task
    public function storeAssignTask(Request $request){
        $task_id_count = Task::where('id',$request->task_id)->count();
        $refNum =   $request->refNum;
       if(!$task_id_count == 0){
         $refNum = $request->refNum = $request->refNum .-1;
       }
        Task::create([
            'refNum' => $refNum,
            'fromSection'=>6,
            'station_id'=>$request->ssnameID,
            'main_alarm'=>$request->mainAlarm,
            'voltage_level'=>$request->voltage_level,
            'work_type'=>$request->work_type,
            'task_date'=>$request->task_Date,
            'equip'=>$request->equip,
            'pm'=>$request->pm,
            'problem' => $request->problem,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
        $task_id = Task::latest()->first()->id;

        TaskDetails::create([
            'task_id'=>$task_id,
            'report_date'=> $request->task_Date,
            'fromSection'=> 6,
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

        }

        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back(); 
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
        return (String) DB::table('engineers')
        ->where('area',$area_id)
        ->where('shift',$shift_id)
        ->Join('users','users.id','=','engineers.user_id')
        ->where('users.section_id',6)
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
        $validated = $request->validate([
            'ssnameID' => 'required|numeric',
        ],
        [
            'ssnameID.required' =>'يرجى اختيار المحطة من القائمة فقط',
            'ssnameID.numeric'=>'يرجى اختيار المحطة من القائمة فقط'

        ]);
        $task_id_count = Task::where('id',$request->task_id)->count();
        $refNum =   $request->refNum;
       if(!$task_id_count == 0){
         $refNum =$request->refNum .-1;
       }
        Task::create([
            'refNum' =>$refNum,
            'fromSection'=>6,
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
            'report_date'=>$request->task_Date,
            'fromSection'=>6,
            'status'=>'pending',
        ]);
        $fromSection =6;
        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/switchgear/' . $task_id), $name);
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
                ->notify(new AddTaskWithAttachments($task_id, $data, $request->station_code,$fromSection));
        }else{
            Notification::route('mail', $engineer_email)
            ->notify(new AddTask($task_id, $request->station_code,$fromSection));
        }


            
        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();

    }

    public function showEngineersReportRequest(){
        $tasks = Task::where('report_status',2)
        ->where('fromSection',6)
        ->get();
        return view('switchgear.admin.tasks.engineersReportRequest',compact('tasks'));
    }
    public function showAllTasks(){
        $tasks = Task::where('fromSection',6)->orWhere('toSection','6')->orderBy('id', 'desc')
        ->get();
        return view('switchgear.admin.tasks.showTasks',compact('tasks'));
    }

    public function showPendingTasks(){
        $tasks = Task::where('fromSection',6)
        ->where('status','pending')
        ->orWhere('toSection',6)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('switchgear.admin.tasks.showTasks',compact('tasks'));  
    }

    public function showCompletedTasks(){
        $tasks = Task::where('fromSection',6)
        ->where('status','completed')
        ->whereMonth('created_at', date('m'))
        ->orWhere('toSection',6)
        ->where('status','completed')
        ->whereMonth('created_at', date('m'))
        ->orderBy('id', 'desc')
        ->orderBy('id', 'desc')
        ->get();
        return view('switchgear.admin.tasks.showTasks',compact('tasks'));
    }
    public function showArchive(){
        $tasks = Task::where('fromSection',6)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('switchgear.admin.tasks.showTasks',compact('tasks'));
    }

    public function userArchive(){
        $tasks = Task::where('fromSection',6)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('switchgear.user.tasks.showTasks',compact('tasks'));
    }
   
    public function taskDetails($id){
        $tasks = Task::where('id',$id)->get();
        $task_details = TaskDetails::where('task_id',$id)->get();
        $task_attachment = TaskAttachment::where('id_task',$id)->get();
        return view('switchgear.admin.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }

    public function showEngineers(){
        // $engineers = Engineer::where('section_id',6)->get();
        // return view ('switchgear.admin.engineers.engineersList',compact('engineers'));

        $engineers = DB::table('engineers')
        ->join('users','users.id','=','engineers.user_id')
        ->select('users.name','users.id','users.email','users.section_id','engineers.area','engineers.shift')
        ->where('users.section_id',6)
        ->get();   
        $users = User::where('section_id',6)->get();   

         return view ('switchgear.admin.engineers.engineersList',compact('engineers','users'));

    }
    public function showUsers(){
        $users = User::where('section_id',6)->get();
        return view('switchgear.admin.users.usersList',compact('users'));
    }
    //get 
    public function updateTask($id){
        $tasks = Task::where('id',$id)->first();
        $fromSection = $tasks->fromSection;
        switch($fromSection){
            case 1:
                $section = Section::where('id',1)->first();
                break;
            case 2:
                $section = Section::where('id',2)->first();
                break;
            case 3:
                 $section = Section::where('id',3)->first();
                break;
            case 4 :
                 $section = Section::where('id',4)->first();
                break;
            case 5 :    
                $section = Section::where('id',5)->first();
                break;       
            default:
            $section = null;           
        }
        $stations = Station::all();
        $sections = Section::all();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
       
        return view('switchgear.admin.tasks.updateTask',compact('tasks','stations','task_attachments','stations','section'));
    }

//post
    public function update(Request $request , $id){
        $tasks = Task::findOrFail($id);
        $fromSection = $tasks->fromSection;
        //check if two sections in this task
        if($tasks->toSection === null){
            $toSection = null;

        }else{
            $toSection = 6;
        }
        $tasks->update([
            'refNum' => $request->refNum,
            'fromSection'=>$fromSection,
            'toSection'=>$toSection,
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
        TaskDetails::create([
            'task_id'=> $id,
            'fromSection'=> 6,
            'eng_id'=>$request->eng_name,
            'report_date'=>$request->task_Date,
            'status' => 'change',

        ]);
        $task_id = $id;
        $engineer_email = $request->eng_email;
        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/switchgear/' . $task_id), $name);
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
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('switchgear/'.$id . '/' . $file_name);
        return response()->file($files);
    }
    public function get_file($id, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('switchgear/'.$id . '/' . $file_name);
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
        ->where('section_id',6)
        ->where('status','completed')
        ->first();
        $commonTasks = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->where('section_id','!=',6)
        ->get();
        return view('switchgear.admin.tasks.report',compact('task_details','commonTasks'));
    }
    
    public function viewCommonReport($id,$section_id){
        $task_details = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->where('section_id',$section_id)
        ->first();
        $commonTasks = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->get();
        return view('switchgear.admin.tasks.report',compact('task_details','commonTasks'));

    }
    ///##### end backend functions

        ####################### USER CONTROLLER ########################
    
    public function userIndex() {
        $tasks = Task::orderBy('id','desc')
        ->where('eng_id',Auth::user()->id)
        ->where('status','pending')
        ->get();
        $task_details = TaskDetails::where('section_id',6)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get(); 
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('switchgear.user.dashboard',compact('tasks','task_details','date','monthName'));
    }

    public function engineerPageTasks($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->get();
        return view('switchgear.user.mytasks', compact('tasks'));
    }
    public function showEngineerTasks($id){
        $tasks = Task::where('eng_id',$id)
            ->orderBy('id', 'desc')
            ->get();
        return view('switchgear.user.tasks.engineertasks', compact('tasks'));
    }
    public function showEngineerTasksUncompleted($id){
        $tasks = Task::where('eng_id',$id)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('switchgear.user.tasks.engineertasks', compact('tasks'));
    }
    public function showEngineerTasksCompleted($id){
        $tasks = TaskDetails::where('eng_id',$id)
        ->where('section_id',6)
        ->orderBy('id', 'desc')
        ->get();
        return view('switchgear.user.tasks.taskCompleted', compact('tasks'));
    }
    public function usertaskDetails($id){
        $tasks = Task::where('id', $id)->get();
        $task_details = TaskDetails::where('task_id', $id)->get();
        $task_attachment = TaskAttachment::where('id_task', $id)->get();
        return view('switchgear.user.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }
    public function engineerPageTasksCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','completed')
            ->get();
        return view('switchgear.user.mytasks', compact('tasks'));
    }
    public function engineerPageTasksUnCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','pending')
            ->get();
        return view('switchgear.user.mytasks', compact('tasks'));
    }
    public function engineerReportForm($id){
        $tasks = Task::where('id',$id)->first();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
        if (!Gate::allows('write-report',$tasks)) {
            abort(403);      
         }
        return view('switchgear.user.EngineerReportForm',compact('tasks','task_attachments'));
    }

    public function SubmitEngineerReport(Request $request,$id){
        $task= Task::findOrFail($id);
        $fromSection = $task->fromSection;
        $toSection = $task->toSection;
        $eng_id = Auth::user()->id;
        TaskDetails::create([
            'task_id' => $id,
            'report_date' => Carbon::now(),
            'eng_id' =>$eng_id,
            'fromSection'=>$fromSection,
            'toSection'=>$toSection,
            'section_id'=> 6,
            'action_take' => $request->action_take,
            'status'=>'completed',
            'report_status'=>1,
        ]);
        $task->update([
            'status'=>'completed',
        ]);
        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/switchgear/' . $id), $name);
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
        $eng_id = Auth::user()->id ;
        //if task Completed
        if ($request->reason === 'مسؤولية جهة آخرى' || $request->reason === "تحت الكفالة") {
            $task->update([
                'status' =>'completed',
            ]);
            TaskDetails::create([
                'task_id'=>$id,
                'fromSection'=>6,
                'section_id'=>6,
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
                'fromSection'=>6,
                'section_id'=>2,
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
            return view('switchgear.user.tasks.editReport',compact('tasks','tasks_details','task_attachments'));
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
                    $file->move(public_path('Attachments/switch/' . $id), $name);
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