<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class CommonTasks extends Component
{    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $section_id = Auth::user()->section_id;

        //to track mutal tasks in diffrent sections  
        $common_tasks_details = Task::where('fromSection',$section_id)
        ->whereNotNull('toSection')
        ->where('toSection','!=',$section_id)
        ->Paginate(1);
        return view('livewire.common-tasks',compact('common_tasks_details'));
    }
}