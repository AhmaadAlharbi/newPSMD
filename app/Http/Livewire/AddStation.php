<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Station;
use App\Models\Equip;

class AddStation extends Component
{
    public $stations = [];
    public $selectedStation;
    public $stationDetails;
    public $station_id;

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
        $this->stationDetails = Station::where('SSNAME', $this->selectedStation)->first();
    }
}