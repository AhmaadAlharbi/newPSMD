<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RSTasks;
use Illuminate\Support\Facades\Auth;

class RelaySettignsController extends Controller
{
    public  function index(){
        return view ('protection.realySetting.index');
    }
    public function store(Request $request){
        RSTasks::create([
            // 'refNum' => $re
            'station_name' => $request->station_name,
            'task_date'=>$request->task_date,
            'deadline'=>$request->deadline,
            'eng_id' => $request->engineer_id,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
    }
}
