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

             //to show reports in admin dashboard
             $task_details= TaskDetails::where('section_id',$section_id)
             ->where('status','completed')
             ->orderBy('id', 'desc')
             ->paginate(2);
        return view('livewire.show-reports',compact('task_details'));
    }
}
