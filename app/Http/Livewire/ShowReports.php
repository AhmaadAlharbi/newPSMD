<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TaskDetails;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $section_id = Auth::user()->section_id;
        if($section_id != 1){
             //to show reports in admin dashboard
             $task_details= TaskDetails::where('section_id',$section_id)
             ->where('status','completed')
             ->orderBy('id', 'desc')
             ->paginate(2);
        }else{
           //edara reports
           $task_details= TaskDetails::where('fromSection',1)
        ->where('status','completed')
        ->orderBy('id', 'desc')
        ->paginate(2);
        }
                  
        return view('livewire.show-reports',compact('task_details'));
    }
}
