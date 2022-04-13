<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\Task;

class LocalTasks extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public function render()
    {
        $section_id = Auth::user()->section_id;

        $tasks = Task::orderBy('id', 'desc')
        ->where('fromSection',$section_id)
        ->whereNull('toSection')
        ->where('status', 'pending')
        ->orWhere('toSection',$section_id)
        ->whereNull('fromSection')
        ->where('status', 'pending')
        ->paginate(1);
        return view('livewire.local-tasks',compact('tasks'));
    }
}