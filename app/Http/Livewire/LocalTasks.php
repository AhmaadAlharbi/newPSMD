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

        if ($section_id != 1) {
            //other sections tasks
            $tasks = Task::orderBy('id', 'desc')
                ->where('fromSection', $section_id)
                ->whereNull('toSection')
                ->where('status', 'pending')
                ->orWhere('toSection', $section_id)
                ->whereNull('fromSection')
                ->where('status', 'pending')
                ->Paginate(5, ['*'], 'localTasks');
        } else {
            //edara's tasks
            $tasks = Task::orderBy('id', 'desc')
                ->where('fromSection', 1)
                ->where('status', 'pending')
                ->paginate(3);
        }



        return view('livewire.local-tasks', compact('tasks'));
    }
}
