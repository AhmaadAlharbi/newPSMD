<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\gc_tasks;
use App\Models\gc_tasks_details;
use App\Models\gc_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use  App\Notifications\EditTask;
use  App\Notifications\gc_AddTask;
use  App\Notifications\AddTaskWithAttachments;

use Illuminate\Http\Request;

class GeneralCheckControllerProtection extends Controller
{
    //!!######## GENERAL CHECK ################!!//
    public function generalCheckIndex()
    {
        $date = Carbon::now();
        $tasks = gc_tasks::orderBy('id', 'DESC')->get();
        $reports = gc_tasks_details::where('status', 'completed')->get();
        $monthName = $date->format('F');
        return view('protection.generalCheck.index', compact('date', 'monthName', 'reports', 'tasks'));
    }
    public function sendGeneralCheck()
    {
        $engineers = DB::table('engineers')
            ->Join('users', 'users.id', '=', 'engineers.user_id')
            ->where('users.section_id', 2)
            ->orderBy('name')
            ->get();
        return view('protection.generalCheck.add_task', compact('engineers'));
    }
    public function generalCheckgetEngineers()
    {
        return (string) DB::table('engineers')
            ->Join('users', 'users.id', '=', 'engineers.user_id')
            ->where('users.section_id', 2)
            ->orderBy('name')
            ->get();
    }
    public function generalCheckGetEmail($id)
    {
        return (string) $engineersTable = DB::table('engineers')
            ->where("name", $id)
            ->join('users', 'users.id', '=', 'engineers.user_id')
            ->select('users.name', 'users.id', 'users.email', 'users.section_id')
            ->get();
    }
    public function store(Request $request)
    {
        gc_tasks::create([
            // 'refNum' => $re
            'section_id' => 2,
            'station_name' => $request->station_name,
            'task_date' => $request->task_Date,
            'ref_book' => $request->ref_book,
            'eng_id' => $request->engineer_id,
            'control' => $request->control,
            'make' => $request->make,
            'contract_number' => $request->contract_number,
            'contractor' => $request->contractor,
            'notes' => $request->notes,
            'status' => 'pending',
            'user_id' => (Auth::user()->id),
        ]);
        $task_id = gc_tasks::latest()->first()->id;
        $engineer_email = $request->eng_email;
        $data = [];
        if ($request->hasfile('pic')) {
            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/general-check/' . $task_id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new gc_attachments();
                $attachments->file_name = $name;
                $attachments->created_by = Auth::user()->name;
                $attachments->id_task = $task_id;
                $attachments->save();
            }
        }
        //to send email
        // Notification::route('mail', $engineer_email)
        //     ->notify(new gc_AddTask($task_id, $data, $request->station_code));
        // session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        // return back();
    }
    //show Engineer Task
    public function showEngineerTask($id)
    {
        $task = gc_tasks::where('id', $id)->first();
        $task_attachments = gc_attachments::where('id_task', $id)->get();
        return view('protection.generalCheck.EngineerReportForm', compact('task', 'task_attachments'));
    }
    //engineer submit Report POST
    public function submitReport(Request $request, $id)
    {
        $task = gc_tasks::findOrFail($id);
        $eng_id = Auth::user()->id;

        $task->update([
            'status' => 'completed',
        ]);
        gc_tasks_details::create([
            'task_id' => $id,
            'report_date' => Carbon::now(),
            'reason' => $request->reason,
            'eng_id' => $eng_id,
            'notes' => $request->engineer_note,
            'status' => 'completed'
        ]);
        session()->flash('Add', 'تم اضافة التقرير بنجاح');
        return back();
    }
    public function gc_showAllTasks()
    {
        $tasks = gc_tasks::whereMonth('created_at', date('m'))
            ->where('section_id', 2)
            ->orderBy('id', 'desc')
            ->get();
        return view('protection.generalCheck.showTasks', compact('tasks'));
    }
    public function gc_pendingTasks()
    {
        $tasks = gc_tasks::where('section_id', 2)
            ->where('status', 'pending')
            ->orderBy('id', 'desc')
            ->get();
        return view('protection.generalCheck.showTasks', compact('tasks'));
    }
    public function gc_completedTasks()
    {
        $tasks = gc_tasks::where('section_id', 2)
            ->where('status', 'completed')
            ->orderBy('id', 'desc')
            ->get();
        return view('protection.generalCheck.showTasks', compact('tasks'));
    }
    public function gc_viewPrintReport($id)
    {
        $task_details = gc_tasks_details::where('task_id', $id)
            ->where('status', 'completed')
            ->first();
        $task_attachment = gc_attachments::where('id_task', $id)->get();

        return view('protection.generalCheck.report', compact('task_details', 'task_attachment'));
    }
}
