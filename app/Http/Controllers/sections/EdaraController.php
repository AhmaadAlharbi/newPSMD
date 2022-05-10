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
use App\Rules\fourName;
use App\Rules\OnlyMewEmail;
class EdaraController extends Controller
{
     //register new  page
     public function registerPage(){
        return view('edara.admin.register');
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
            'section_id'=>1,
            'password' => Hash::make($request->password),
            'is_admin'=>1,
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::ProtectionHomeUser);

    }

    //home  page
    public function index(){
        $tasks = Task::orderBy('id', 'desc')
        ->where('fromSection',1)
        ->where('status', 'pending')
        ->get();
        $task_details= TaskDetails::where('fromSection',1)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        $date = Carbon::now();
        $monthName = $date->format('F');
        return view('edara.admin.dashboard',compact('tasks','task_details','date','monthName'));
    }
    public function add_task(){
        if(isset(Task::latest()->first()->id)){
            $task_id = Task::latest()->first()->id;
            $task_id++;
        }else{
            $task_id = 1;
        }
        $stations = Station::all();
        $sections = Section::all();
        return view ('edara.admin.tasks.add_task',compact('stations','task_id','sections'));
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
        return view ('edara.admin.tasks.assign_task',compact('stations','task_id'));
    }

    public function store(Request $request){ 
        //chekc if ref Num in database or not
         $task_id_count = Task::where('id',$request->task_id)->count();
         $refNum =   $request->refNum;
        if(!$task_id_count == 0){
          $refNum = $request->refNum = $request->refNum .-1;
        }
        Task::create([
            'refNum' => $refNum,
            'fromSection'=>1,
            'toSection'=>$request->section,
            'station_id'=>$request->ssnameID,
            'main_alarm'=>$request->mainAlarm,
            'task_date'=>$request->task_Date,
            'equip'=>$request->equip,
            'pm'=>$request->pm,
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
            'fromSection'=>1,
            'status'=>'pending',
        ]);

        $fromSection =1;
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
    //store assign task
    public function storeAssignTask(Request $request){
        $task_id_count = Task::where('id',$request->task_id)->count();
        $refNum =   $request->refNum;
       if(!$task_id_count == 0){
         $refNum = $request->refNum = $request->refNum .-1;
       }
        Task::create([
            'refNum' => $refNum,
            'fromSection'=>1,
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
            'fromSection'=> 1,
            'status'=>'pending',
        ]);

        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/edara/' . $task_id), $name);
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
    public function showAllTasks(){
        $tasks = Task::where('fromSection',1)->orderBy('id', 'desc')
        ->get();
        $sections = Section::all();
        return view('edara.admin.tasks.showTasks',compact('tasks','sections'));
    }

    public function showPendingTasks(){
        $tasks = Task::where('fromSection',1)
        ->where('status','pending')
        ->orderBy('id', 'desc')
        ->get();
        return view('edara.admin.tasks.showTasks',compact('tasks'));  
    }

    public function showCompletedTasks(){
        $tasks = Task::where('fromSection',1)
        ->where('status','completed')
        ->whereMonth('created_at', date('m'))
        ->orderBy('id', 'desc')
        ->get();
        return view('edara.admin.tasks.showTasks',compact('tasks'));
    }
    public function showArchive(){
        $tasks = Task::where('fromSection',1)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->get();
        return view('edara.admin.tasks.showTasks',compact('tasks'));
    }

    public function taskDetails($id){
        $tasks = Task::where('id',$id)->get();
        $task_details = TaskDetails::where('task_id',$id)->get();
        $task_attachment = TaskAttachment::where('id_task',$id)->get();
        return view('edara.admin.tasks.taskDetails',compact('tasks','task_details','task_attachment'));
    }

    public function showUsers(){
        $users = User::where('section_id',1)->get();
        return view('edara.admin.users.usersList',compact('users'));
    }

        //change section view
        public function changeSectionView($id){
            $tasks = Task::where('id',$id)->first();
            $stations = Station::all();
            $sections = Section::all();
            $task_attachments = TaskAttachment::where('id_task',$id)->get();
    
            return view('edara.admin.tasks.changeSection',compact('tasks','stations','task_attachments','sections'));
    
        }

         //change section
    public function changeSection($id,Request $request){
            $tasks = Task::where('id',$id)->first();
            $tasks_details = TaskDetails::where('task_id',$id)->first();
            $date = Carbon::now();
            $tasks->update([
                'fromSection'=>$request->section_id,
                'eng_id'=>null,
                'status'=>'pending',
            ]);
            $tasks_details->create([
                'task_id'=> $id,
                'fromSection'=>$request->section_id,
                'eng_id'=>null,
                'report_date'=>$date,
                'status' => 'change',

            ]);
            return back();
        }

      //get 
      public function updateTask($id){
        $tasks = Task::where('id',$id)->first();
        $stations = Station::all();
        $sections = Section::all();
        $task_attachments = TaskAttachment::where('id_task',$id)->get();
       
        return view('edara.admin.tasks.updateTask',compact('tasks','stations','task_attachments','sections'));
    }

    //post
    public function update(Request $request , $id){
        $date = Carbon::now();
        $tasks = Task::findOrFail($id);
        $tasks->update([
            'refNum' => $request->refNum,
            'fromSection'=>1,
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
            'fromSection'=> 1,
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
        ->where('fromSection',1)
        ->first();
        $commonTasks = TaskDetails::where('task_id',$id)
        ->where('fromSection','!=',1)
        ->where('status','completed')
        ->get();
        return view('edara.admin.tasks.report',compact('task_details','commonTasks'));
    }
    public function viewCommonReport($id,$section_id){
        $task_details = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->where('fromSection',$section_id)

        ->first();
        $commonTasks = TaskDetails::where('task_id',$id)
        ->where('status','completed')
        ->get();
        return view('edara.admin.tasks.report',compact('task_details','commonTasks'));

    }

        //get station
        public function getStations($SSNAME){
            return (string) Station::where("SSNAME",$SSNAME)
            ->first(); 
        }

}