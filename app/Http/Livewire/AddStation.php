<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Station;
use App\Models\Equip;
use App\Models\Engineer;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use DateTime;
use Illuminate\Support\Facades\Route;

use  App\Notifications\AddTask;
use Illuminate\Support\Facades\Notification;

use  App\Notifications\AddTaskWithAttachments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AddStation extends Component
{
    use WithFileUploads;
    public $task;
    public $stations = [];
    public $selectedStation;
    public $stationDetails;
    public $station_id;
    public $voltage = [];
    public $selectedVoltage;
    public $equip = [];
    public $selectedEquip;
    public $transformers = [];
    public $selectedTransformer;
    public $engineers = [];
    public $selectedEngineer;
    public $area = 0;
    public $engineerEmail;
    public $duty = false;
    public $main_alarm;
    public $work_type;
    public $date;
    public $problem;
    public $notes;
    public $photos = [];
    public $pic1;
    public $pic2;
    public $selectedEquipTr;
    public $route_id;
    protected $listeners = ['callEngineer' => 'getEngineer'];
    // protected $rules = [
    //     'selectedStation' => 'required ',
    //     'photos.*' => 'max:1024', // 1MB Max

    // ];
    public function mount(Request $request)
    {

        // Retrieve the id parameter from the route
        $this->route_id = $request->route('id');
        // Query the table using the id parameter
        $this->task = Task::find($this->route_id);
        $this->stations = Station::all();
    }
    public function render(Request $request)
    {
        $this->route_id = $request->route('id');

        if (isset($this->route_id)) {

            $task = Task::where('id', $this->route_id)->first();
            $this->selectedStation = Station::where('id', $task->station_id)->pluck('SSNAME')->first();
            $this->stationDetails = Station::where('SSNAME', $this->selectedStation)->first();
            if ($this->stationDetails !== null) {
                $this->station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();
                // $this->voltage = Equip::where('station_id', $this->station_id)->distinct()->pluck('voltage_level');

                if (
                    $this->stationDetails->control === 'JAHRA CONTROL CENTER'
                    || $this->stationDetails->control === 'TOWN CONTROL CENTER'
                ) {
                    $this->area = 1;
                } elseif (
                    $this->stationDetails->control === 'SHUAIBA CONTROL CENTER'
                    || $this->stationDetails->control === 'JABRIYA CONTROL CENTER'
                ) {
                    $this->area = 2;
                } else {
                    $this->area = 3;
                }
                $this->emit('callEngineer', $this->area);
            }
            $this->main_alarm = $task->main_alarm;
            $this->selectedVoltage = $task->voltage_level;
            $this->selectedEquip = $task->equip_number;
            //check if engineer in duty or not to show the list
            $this->engineers = Engineer::where('user_id', $task->eng_id)->first();
            if ($this->engineers->shift == 1) {
                $this->duty = true;
            }
            $this->work_type = $task->work_type;
            $this->problem = $task->problem;
            $this->selectedEngineer = $task->eng_id;
            $this->notes = $task->notes;
            $this->getStationInfo();
            $this->getEquip();
            $this->getEngineer();
        }

        return view('livewire.add-station');
    }
    public function getStationInfo()
    {

        if (!isset($this->route_id)) {
            $this->engineers = [];
            $this->voltage = [];
            $this->transformers = [];
            $this->equip = [];
            $this->area = 0;
            $this->main_alarm = '';
            $this->engineerEmail = '';
            $this->selectedVoltage = '';
            $this->selectedEquip = '';
            $this->selectedEngineer = '';
        }

        $this->stationDetails = Station::where('SSNAME', $this->selectedStation)->first();
        if ($this->stationDetails !== null) {
            $this->station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();
            // $this->voltage = Equip::where('station_id', $this->station_id)->distinct()->pluck('voltage_level');

            if (
                $this->stationDetails->control === 'JAHRA CONTROL CENTER'
                || $this->stationDetails->control === 'TOWN CONTROL CENTER'
            ) {
                $this->area = 1;
            } elseif (
                $this->stationDetails->control === 'SHUAIBA CONTROL CENTER'
                || $this->stationDetails->control === 'JABRIYA CONTROL CENTER'
            ) {
                $this->area = 2;
            } else {
                $this->area = 3;
            }
            $this->emit('callEngineer', $this->area);
        }
    }
    public function getEquip()
    {
        $this->equip = [];
        if ($this->selectedVoltage !== '-1') {
            if (!isset($this->route_id)) {
                $this->voltage = [];
            }
            $this->station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();
            switch ($this->main_alarm) {
                case ('General Alarm 11KV'):
                    $this->voltage = [];
                    array_push($this->voltage, "11KV");
                    $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

                    break;
                case ('Auto reclosure'):
                case ('Pilot Cable Fault Alarm'):
                case ('General Alarm 33KV'):
                    $this->voltage = [];
                    array_push($this->voltage, "33KV");
                    $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

                    break;
                case ('Dist Prot Main Alaram'):
                case ('Dist.Prot.Main B Alarm'):
                case ('Pilot cable Superv.Supply Fail Alarm'):
                case ('General Alarm 132KV'):
                    $this->voltage = [];
                    array_push($this->voltage, "132KV");
                    $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

                    break;
                case ('DC Supply 1 & 2 Fail Alarm'):
                    $this->voltage = [];
                    break;
                case ('General Alarm 300KV'):
                    $this->voltage = [];
                    array_push($this->voltage, "300KV");
                    $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

                    break;
                case ('B/Bar Protection Fail Alarm'):
                    $this->voltage = [];
                    array_push($this->voltage, "400KV", "300KV", "132KV", "33KV");
                    $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

                    break;
                case ('Transformer Clearance'):
                case ('Transformer out of step Alarm'):
                    $this->voltage = [];
                    $this->equip = [];
                    // $this->voltage = Equip::where('station_id', $this->station_id)->where('equip_name', 'LIKE', '%TR%')->distinct()->pluck('equip_name');
                    // $this->voltage = Equip::selectRaw('substr(equip_name,1,2)')->where('equip_name', 'LIKE', '%TR%')->distinct()->get();
                    $this->transformers = Equip::where('station_id', $this->station_id)->where('equip_name', 'LIKE', '%TR%')->distinct()->pluck('equip_name');
                    $this->equip = Equip::where('station_id', $this->station_id)->where('equip_name', $this->selectedVoltage)->distinct()->pluck('equip_number');
                    break;
                default:
                    $this->equip = [];
                    $this->voltage = Equip::where('station_id', $this->station_id)->distinct()->pluck('voltage_level');
                    $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();
            }

            // $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

            // $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();

        }
    }
    public function getEngineer()
    {
        if ($this->area == 3) {
            if ($this->duty === false) {
                $this->engineers = Engineer::where('section_id', 2)->where('shift', 0)->get();
            } else {
                $this->engineers = Engineer::where('section_id', 2)->where('shift', 1)->get();
            }
        } else {
            if ($this->duty === false) {
                $this->engineers = Engineer::where('section_id', 2)->where('area', $this->area)->where('shift', 0)->get();
            } else {
                $this->engineers = Engineer::where('section_id', 2)->where('area', $this->area)->where('shift', 1)->get();
            }
        }
    }
    public function getEmail()
    {
        $this->engineerEmail = User::where('id', $this->selectedEngineer)->pluck('email')->first();
    }

    public function submit()
    {
        $this->date =  Carbon::now();
        $year = (new DateTime)->format("Y");
        $month = (new DateTime)->format("m");
        $day = (new DateTime)->format("d");
        $refNum = $year . "/" . $month . "/" . $day . '-' . rand(1, 10000);
        $station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();


        $taskId = app('router')->current()->parameter('id');

        if ($taskId) {
            // Update the task
            $task = Task::findOrFail($taskId);
            $task->update([
                'section_id' => 2,
                'fromSection' => 2,
                'station_id' => 2,
                'main_alarm' => $this->main_alarm,
                'voltage_level' => $this->selectedVoltage,
                'work_type' => $this->work_type,
                'equip_number' => $this->selectedEquip,
                // 'equip_name' => $request->equip_name,
                // 'pm' => $request->pm,
                'eng_id' => $this->selectedEngineer,
                'problem' => $this->problem,
                'notes' => $this->notes,
                'status' => 'pending',
                'user' => (Auth::user()->name),
            ]);
        } else {
            // Create a new task
            $task = Task::create([
                'refNum' => $refNum,
                'section_id' => 2,
                'fromSection' => 2,
                'station_id' => $station_id,
                'main_alarm' => $this->main_alarm,
                'voltage_level' => $this->selectedVoltage,
                'work_type' => $this->work_type,
                'task_date' =>  $year . '-' . $month . '-' . $day,
                'equip_number' => $this->selectedEquip,
                // 'equip_name' => $request->equip_name,
                // 'pm' => $request->pm,
                'eng_id' => $this->selectedEngineer,
                'problem' => $this->problem,
                'notes' => $this->notes,
                'status' => 'pending',
                'user' => (Auth::user()->name),
            ]);
        }



        session()->flash('message', 'تم تعديل المهمة بنجاح.');
        return   back();
    }
}
