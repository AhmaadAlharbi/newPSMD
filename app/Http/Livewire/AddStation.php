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
    protected $listeners = ['callEngineer' => 'getEngineer'];

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
        $this->stationDetails = Station::where('SSNAME', $this->selectedStation)->first();
        if ($this->stationDetails !== null) {
            $this->station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();
            $this->voltage = Equip::where('station_id', $this->station_id)->distinct()->pluck('voltage_level');
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

            $this->station_id = Station::where('SSNAME', $this->selectedStation)->pluck('id')->first();
            $this->equip = Equip::where('station_id', $this->station_id)->where('voltage_level', $this->selectedVoltage)->get();
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
}