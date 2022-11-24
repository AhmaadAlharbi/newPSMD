<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Station;
use App\Models\Equip;
use App\Models\Engineer;
use App\Models\User;

class AddStation extends Component
{
    public $stations = [];
    public $selectedStation;
    public $stationDetails;
    public $station_id;
    public $voltage = [];
    public $selectedVoltage;
    public $equip = [];
    public $selectedEquip;
    public $engineers = [];
    public $selectedEngineer;
    public $area = 0;
    public $engineerEmail;
    public $duty = false;
    public $main_alarm;
    protected $listeners = ['callEngineer' => 'getEngineer'];
    protected $rules = [
        'selectedStation' => 'required',
    ];
    public function mount()
    {
        $this->stations = Station::all();
    }
    public function render()
    {
        return view('livewire.add-station');
    }
    public function getStationInfo()
    {

        $this->area = 0;
        $this->engineerEmail = '';
        $this->selectedVoltage = '';
        $this->selectedEquip = '';
        $this->selectedEngineer = '';
        $this->stationDetails = Station::where('SSNAME', $this->selectedStation)->first();
        if ($this->stationDetails !== null) {
            $this->station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();
            // $this->voltage = Equip::where('station_id', $this->station_id)->distinct()->pluck('voltage_level');

            if ($this->stationDetails->control === 'JAHRA CONTROL CENTER' || $this->stationDetails->control === 'TOWN CONTROL CENTER') {
                $this->area = 1;
            } elseif ($this->stationDetails->control === 'SHUAIBA CONTROL CENTER' || $this->stationDetails->control === 'JABRIYA CONTROL CENTER') {
                $this->area = 2;
            } else {
                $this->area = 3;
            }
            $this->emit('callEngineer', $this->area);
        }
    }
    public function getEquip()
    {
        sleep(1);

        if ($this->selectedVoltage !== '-1') {
            $this->voltage = [];
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
                    $this->voltage = Equip::where('station_id', $this->station_id)->where('equip_name', 'LIKE', '%TR%')->distinct()->pluck('voltage_level');
                    $this->equip = Equip::where('station_id', $this->station_id)->where('equip_name', 'LIKE', '%TR%')->where('voltage_level', $this->selectedVoltage)->get();
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
        $this->validate();
    }
}