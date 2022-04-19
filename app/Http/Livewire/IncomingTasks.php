<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class IncomingTasks extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    { 
        $section_id = Auth::user()->section_id;
        $incomingTasks = Task::Where('toSection',$section_id)
        ->whereNotNull('fromSection')
        ->where('status', 'pending')
        ->Paginate(1);
        return view('livewire.incoming-tasks',compact('incomingTasks'));
    }
}