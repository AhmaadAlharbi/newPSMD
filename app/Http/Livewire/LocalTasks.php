<?php

namespace App\Http\Livewire;

use App\Models\Station;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\Task;
use App\Models\TaskDetails;

class LocalTasks extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public function render()
    {
        $section_id = Auth::user()->section_id;
        $routeName = Request::route()->getName();
        if($routeName == 'dashboardControl.admin.protection'){
            $tasks = Task::whereHas('station', function (Builder $query) {
                $query->where('control', 'like', 'SHUAIBA CONTROL CENTER');
            })->paginate(3);
            return view('livewire.local-tasks', compact('tasks'));

        }


      if ($section_id != 1 && $routeName !== 'dashboardControl.admin.protection' ) {
            //other sections tasks
            $tasks = Task::orderBy('id', 'desc')
                ->where('fromSection', $section_id)
                ->whereNull('toSection')
                ->where('status', 'pending')
                ->orWhere('toSection', $section_id)
                ->whereNull('fromSection')
                ->where('status', 'pending')
                ->Paginate(5, ['*'], 'localTasks');
            $pedningTask = TaskDetails::where('fromSection', $section_id)
                ->whereNotNull('reasonOfUncompleted')
                ->orWhere('toSection', $section_id)
                ->whereNotNull('reasonOfUncompleted')
                ->get();
        } else {
            //edara's tasks
            $tasks = Task::orderBy('id', 'desc')
                ->where('fromSection', 1)
                ->where('status', 'pending')
                ->paginate(3);
            $pedningTask = null;
        }

        return view('livewire.local-tasks', compact('tasks', 'pedningTask'));
    }
}
