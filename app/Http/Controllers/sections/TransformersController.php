<?php
namespace App\Http\Controllers\sections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Engineer;
use App\Models\User;
use App\Models\Station;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\TaskDetails;
use App\Models\TaskAttachment;
use App\Models\TR;
use App\Models\TrTasks;
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
use App\Rules\fourName;
use App\Rules\OnlyMewEmail;
class TransformersController extends Controller
{
       ###################### ADMIN CONTROLLER ########################
     //register new  page
     public function registerPage(){
        return view('transformers.admin.register');
    }
    //sign up users
    public function register(Request $request){
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',new OnlyMewEmail],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    $fullname = $request->fname . " " . $request->sname . " " . $request->tname . " " . $request->lname ; 
        $user = User::create([
            'name' => $fullname,
            'email' => $request->email,
            'section_id'=>5,
            'password' => Hash::make($request->password),
            'is_admin'=>0,
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::TransformersHomeUser);

    }

    //sign up a new user from admin dashboard
    public function newuser(Request $request){
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',new OnlyMewEmail],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    $fullname = $request->fname . " " . $request->sname . " " . $request->tname . " " . $request->lname ; 
        $user = User::create([
            'name' => $fullname,
            'email' => $request->email,
            'section_id'=>5,
            'password' => Hash::make($request->password),
            'is_admin'=>0,
        ]);
        session()->flash('Add', 'تم اضافة الموظف بنجاح');
        $users = User::all();
        return view('transformers.admin.users.usersList',compact('users'));
    }
    public function index(){
        $tasks = Task::orderBy('id', 'desc')
        ->where('fromSection',5)
        ->whereNull('toSection')
        ->where('status', 'pending')
        ->orWhere('toSection',5)
        ->whereNull('fromSection')
        ->where('status', 'pending')
        ->get();
        $incomingTasks = Task::Where('toSection',5)
        ->whereNotNull('fromSection')
        ->where('status', 'pending')
        ->get();
         //to show reports in admin dashboard
         $task_details= TaskDetails::where('section_id',5)
         ->where('status','completed')
         ->orderBy('id', 'desc')
         ->get();
      //to track mutal tasks in diffrent sections  
      $common_tasks_details = Task::where('fromSection',5)
      ->whereNotNull('toSection')
      ->get();
        $tr_tasks= DB::table('tr_tasks')
        ->join('tasks','tasks.id','=','tr_tasks.task_id')
        ->where('tasks.status','pending')
        ->get();  
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('transformers.admin.dashboard',compact('tasks','task_details','date','monthName','tr_tasks','incomingTasks','common_tasks_details'));
    }
     //// start front END functions


     //add tasks to admins
    public function add_task(){
        if(isset(Task::latest()->first()->id)){
            $task_id = Task::latest()->first()->id;
            $task_id++;
        }else{
            $task_id = 1;
        }
        $stations = Station::all();
        return view ('transformers.admin.tasks.add_task',compact('stations','task_id'));
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
         return view ('transformers.admin.tasks.assign_task',compact('stations','task_id'));
    }
        //get user email
    public function getUserEmail($user_name){
            return (String) User::where('name',$user_name)->first();
        }
         //updateuser get
      public function editUser($id){
        $user = User::findOrFail($id);
        return view('transformers.admin.users.update_user',compact('user'));

    }
    //update user post
    public function updateUser(Request $request,$id){
        $user = User::findOrFail($id);
        $user_tr =TR::where('user_id',$id)->first();
        $user->update([
            'name'=>$request->eng_name,
            'email'=>$request->email,
     
        ]);
        $user_tr->update([
            'department'=>$request->department,
        ]);
        session()->flash('edit', 'تم   التعديل  بنجاح');
        return back();
    }
    public function addEngineer(Request $request){
            TR::create([
                'user_id'=>$request->user_id,
                'department'=>$request->department,
                'area'=>$request->area_id,
                'shift'=>$request->shift_id,
            ]);
            session()->flash('Add','تم الاضافة بنجاح');
            return back();
        }
    //edit Engineer get
        public function editEngineer($id){
            $engineer = TR::where('user_id',$id)->first();
            return view('transformers.admin.engineers.update_Engineer',compact('engineer'));
        
         }

 //update engineer post
    public function updateEngineer(Request $request,$id){
        $engineer = TR::where('user_id',$id)->first();
        $engineer->update([
            'department'=>$request->department,
            'area'=>$request->area_id,
            'shift'=>$request->shift_id,
    
        ]);
        session()->flash('edit', 'تم   التعديل  بنجاح');
        return back();
    }
       //get all Engineer  JSON
    public function getEngineerName($area,$department,$shift){
        $shift = 1;
        return (String) $tr = DB::table('tr')
        ->where("area",$area)
        ->where('department',$department)
        ->where('shift',$shift)
        ->where('admin',0)
        ->join('users','users.id','=','tr.user_id')
        ->select('users.name','users.id','users.email')
        ->get();  
    }
    //get Engineer Email
    public function getEngineersEmail($eng_id){
        return (string) TR::where('id',$eng_id)
        ->first();
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
            'fromSection'=>5,
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
            'fromSection'=>5,
            'status'=>'pending',

        ]);
        TrTasks::create([
            'task_id'=>$task_id,
            'work_type'=>$request->work_type,
            'work_type_description'=>$request->work_type_description,
            'department'=>$request->department,
            'area'=>$request->area,
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
    public function getAdminsEmail($id){
        return (String) User::where('id',$id)->first();
    }

    public function getAdmins($area,$department){
       return (String) $tr = DB::table('tr')
        ->where("area",$area)
        ->where('department',$department)
        ->where('is_admin',1)
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
        $task_id_count = Task::where('id',$request->task_id)->count();
        $refNum =   $request->refNum;
       if(!$task_id_count == 0){
         $refNum =$request->refNum .-1;
       }
        Task::create([
            'refNum' => $refNum,
            'fromSection'=>5,
            'station_id'=>$request->ssnameID,
            'main_alarm'=>$request->mainAlarm,
            'work_type'=>$request->work_type,
            'task_date'=>$request->task_Date,
            'equip'=>$request->equip,
            'pm'=>$request->pm,
            'eng_id'=>$request->eng_name,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
        $task_id = Task::latest()->first()->id;
        $engineer_email = $request->eng_email;
        TaskDetails::create([
            'task_id'=>$task_id,
            'eng_id'=>$request->eng_name,
            'fromSection'=> 5,
            'status'=>'pending',
            'report_date'=>$request->task_Date,
        ]);
        TrTasks::create([
            'task_id'=>$task_id,
            'work_type'=>$request->work_type,
            'work_type_description'=>$request->work_type_description,
            'department'=>$request->department,
            'area'=>$request->area,
        ]);
        $fromSection = 5;

        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/transformers/' . $task_id), $name);
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
            ->notify(new AddTask($task_id, $request->station_code,$fromSection));
        }
 

        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();

    }
    public function showEngineersReportRequest(){
        $tasks = TaskDetails::where('report_status',2)
        ->where('section_id',5)
        ->where('status','completed')
        ->get();
        return view('transformers.admin.tasks.engineersReportRequest',compact('tasks'));
    }
    public function showAllTasks(){
        $tasks = Task::whereMonth('created_at', date('m'))
        ->where('fromSection',5)
        ->orWhere('toSection',5)
        ->orderBy('id', 'desc')
        ->get();
        return view('transformers.admin.tasks.showTasks',compact('tasks'));
    }

    public function showPendingTasks(){
        $tasks = Task::where('fromSection',5)
        ->where('status','pending')
        ->orWhere('toSection',5)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('transformers.admin.tasks.showTasks',compact('tasks'));  
    }

    public function showCompletedTasks(){
        $tasks = TaskDetails::where('section_id',5)->whereMonth('created_at',date('m'))->get();
        return view('transformers.admin.tasks.completedTasks',compact('tasks'));
    }
    public function showArchive(){
        $tasks = TaskDetails::where('section_id',5)->get();
        return view('transformers.admin.tasks.completedTasks',compact('tasks'));
    }

    public function userArchive(){
        $tasks = TaskDetails::where('section_id',5)->get();
        return view('transformers.users.tasks.completedTasks',compact('tasks'));
    }
   
    public function taskDetails($id){
        $tasks = Task::where('id',$id)->get();
        $task_details = TaskDetails::where('task_id',$id)->get();
        $task_attachment = TaskAttachment::where('id_task',$id)->get();
        return view('transformers.admin.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }

    public function showEngineers(){
        // $engineers = Engineer::where('section_id',5)->get();
        $engineers = TR::all();
        $users = User::where('section_id',5)->get();   
        return view ('transformers.admin.engineers.engineersList',compact('engineers','users'));
    }
    public function showUsers(){
        $users = User::where('section_id',5)->get();
        return view('transformers.admin.users.usersList',compact('users'));
    }
     //change section view
     public function changeSectionView($id){
        $tasks = Task::where('id',$id)->first();
        $stations = Station::all();
        $sections = Section::all();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();

        return view('transformers.admin.tasks.changeSection',compact('tasks','stations','task_attachments','sections'));

    }
     //change section
     public function changeSection($id,Request $request){
        $tasks = Task::where('id',$id)->first();
        $tasks_details = TaskDetails::where('task_id',$id)->first();
        $tr_Tasks = TrTasks::where('task_id',$id);
        $date = Carbon::now();
        $fromSection = $tasks->fromSection;
        $toSection = $request->section_id;
        if($fromSection !== 1){
            $fromSection =5;
        }
        $tasks->update([
            'fromSection'=>$fromSection,
            'toSection'=> $request->section_id,
            'eng_id'=> null,
            'status'=>'pending',
        ]);
        $tasks_details->create([
            'task_id'=> $id,
            'fromSection'=>5,
            'toSection'=>$request->section_id,
            'eng_id'=>null,
            'report_date'=>$date,
            'status' => 'change',
        ]);
        //check if tasks is added in task Tr table or not (tasks comes from another sections)
        if(!isset($tr_task)){
            TrTasks::create([
                'task_id'=>$id,
                'department'=>1,
                'area'=>1,
            ]);
        }
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
            case 6 :    
                $section = Section::where('id',6)->first();
                break;         
                            
            default:
            $section = null;           
        }
        $stations = Station::all();
        $sections = Section::where('id','!=',5)->get();

        $task_attachments = TaskAttachment::where('id_task',$id)->get();
        $tr_task = TrTasks::where('task_id',$id)->first();
        return view('transformers.admin.tasks.updateTask',compact('tasks','stations','task_attachments','tr_task','sections','section'));
    }

//post
    public function update(Request $request , $id){
        $date = Carbon::now();
        $tasks = Task::findOrFail($id);
        $task_Details = TaskDetails::where('task_id',$id);
        $tr_Tasks = TrTasks::where('task_id',$id);
        $date = Carbon::now();
        $fromSection = $tasks->fromSection;
        $toSection = $tasks->toSection;  
        if($fromSection === 5){
            $toSection = null;
        }
        $tasks->update([
            'refNum' => $request->refNum,
            'fromSection'=>$fromSection,
            'toSection'=>$toSection,
            'main_alarm'=>$request->mainAlarm,
            'work_type'=>$request->work_type,
            'task_date'=>$request->task_Date,
            'equip'=>$request->equip,
            'pm'=>$request->pm,
            'eng_id'=>$request->eng_name,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
        $engineer_email = $request->eng_email;
        TaskDetails::create([
            'task_id'=> $id,
            'fromSection'=> 5,
            'eng_id'=>$request->eng_name,
            'report_date'=>$request->task_Date,
            'status' => 'change',
        ]);
        
        //check if tasks is added in task Tr table or not (tasks comes from another sections)
        if(!isset($tr_task)){
            TrTasks::create([
                'task_id'=>$id,
                'work_type'=>$request->work_type,
                'work_type_description'=>$request->work_type_description,
                'department'=>$request->department,
                'area'=>$request->area,
            ]);
        }else{
            $tr_Tasks->update([
                'work_type'=>$request->work_type,
                'work_type_description'=>$request->work_type_description,
                'department'=>$request->department,
                'area'=>$request->area,
            ]);
        }
        $task_id = $id;
        $fromSection = 5;

        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/transformers/' . $task_id), $name);
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
            ->notify(new AddTask($task_id, $request->station_code,$fromSection));
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
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('transformers/'.$id . '/' . $file_name);
        return response()->file($files);
    }
    public function get_file($id, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('transformers/'.$id . '/' . $file_name);
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
        $commonTasks = TaskDetails::where('task_id',$id)
        ->where('fromSection','!=',5)
        ->where('toSection','!=',5)
        ->where('status','completed')
        ->get();;
        return view('Transformers.admin.tasks.report',compact('task_details','commonTasks'));
    }
    public function viewCommonReport($id,$section_id){
        $task_details = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->where('section_id',$section_id)
        ->first();
        $commonTasks = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->get();
        return view('transformers.admin.tasks.report',compact('task_details','commonTasks'));

    }
     ///##### end backend functions

        ####################### USER CONTROLLER ########################
    
    public function userIndex() {
        $tasks = Task::orderBy('id','desc')
        ->where('eng_id',Auth::user()->id)
        ->where('status','pending')
        ->get();
        $task_details= TaskDetails::where('section_id',5)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get(); 

 


        $tr_tasks= DB::table('tr_tasks')
        ->join('tasks','tasks.id','=','tr_tasks.task_id')
        ->where('tasks.status','pending')
        ->get();  
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('transformers.user.dashboard',compact('tasks','task_details','date','monthName','tr_tasks'));
    }

    public function engineerPageTasks($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->get();
        return view('transformers.user.mytasks', compact('tasks'));
    }
    public function usertaskDetails($id){
        $tasks = Task::where('id', $id)->get();
        $task_details = TaskDetails::where('task_id', $id)->get();
        $task_attachment = TaskAttachment::where('id_task', $id)->get();
        return view('transformers.user.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }
    public function engineerPageTasksCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','completed')
            ->get();
        return view('transformers.user.mytasks', compact('tasks'));
    }
    public function engineerPageTasksUnCompleted($id){
        $engineer = Engineer::where('email',$id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->where('status','pending')
            ->get();
        return view('transformers.user.mytasks', compact('tasks'));
    }
    public function showEngineerTasks($id){
        $tasks = Task::where('eng_id',$id)
            ->orderBy('id', 'desc')
            ->get();
        return view('transformers.user.tasks.engineertasks', compact('tasks'));
    }
    public function showEngineerTasksUncompleted($id){
        $tasks = Task::where('eng_id',$id)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('transformers.user.tasks.engineertasks', compact('tasks'));
    }
    public function showEngineerTasksCompleted($id){
        $tasks = TaskDetails::where('eng_id',$id)
        ->where('section_id',5)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('transformers.user.tasks.taskCompleted', compact('tasks'));
    }
    public function engineerReportForm($id){
        $tasks = Task::where('id',$id)->first();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
           if (!Gate::allows('write-report',$tasks)) {
            abort(403);
            
        }
        $tasks = Task::where('id',$id)->first();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
        return view('transformers.user.EngineerReportForm',compact('tasks','task_attachments'));
    }

    public function SubmitEngineerReport(Request $request,$id){
        $task= Task::findOrFail($id);
        $fromSection = $task->fromSection;
        $toSection = $task->toSection;
        $main_alarm = $task->main_alarm;
        $problem = $task->problem;
        $eng_id = Auth::user()->id;
        TaskDetails::create([
            'task_id' => $id,
            'report_date' => Carbon::now(),
            'eng_id' =>$eng_id,
            'fromSection'=>$fromSection,
            'toSection'=>$toSection,
            'section_id'=> 5,
            'main_alarm'=>$main_alarm,
            'problem'=>$problem,
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
        return redirect()->route('transformers.user.homepage');

    }

    public function engineerReportUnCompleted(Request $request,$id){
        $task= Task::findOrFail($id);
        $eng_id = Auth::user()->id;
        //if task Completed
        if ($request->reason === 'مسؤولية جهة آخرى' || $request->reason === "تحت الكفالة") {
            $task->update([
                'status' =>'completed',
            ]);
            TaskDetails::create([
                'task_id'=>$id,
                'fromSection'=>5,
                'section_id'=>5,
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
                'section_id'=>5,
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
        $task = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->where('section_id',5)
        ->where('eng_id',Auth::user()->id)
        ->first();
        $task->update([
            'report_status'=>2,
        ]);
        return back();
    }
    public function allowEngineersReportRequest($id){
        $task = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->where('section_id',5)
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
            return view('transformers.user.tasks.editReport',compact('tasks','tasks_details','task_attachments'));
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
                    $file->move(public_path('Attachments/transformers/' . $id), $name);
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