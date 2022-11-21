<div class="col-12 my-2">

    <label for="">المحطة</label>
    <input list="ssnames" wire:change="getVoltage" class="form-control my-3" value="" wire:model="selectedStation"
        name="station_code" id="ssname" onchange="getStation()" type="search">
    <datalist id="ssnames">
        @foreach ($stations as $station)
        <option value="{{ $station->SSNAME }}">
            @endforeach
    </datalist>


    <div class="col-12">
        <label for="">Voltage</label>
        <select wire:model="selectedVoltage" wire:change="getEquip" class="form-control mb-3" name="equip_name" id="">
            <option value="-1">Please select Voltage</option>

            @foreach($voltage as $v)
            <option value="{{$v}}">{{$v}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label for="">Equip </label>

        <select wire:model="selectedEquip" class="form-control" name="" id="">
            <option value="-1">Please select Equip</option>

            @foreach($equip as $equip)
            <option value="{{$equip->equip_number}} - {{$equip->equip_name}}">{{$equip->equip_number}} -
                {{$equip->equip_name}}</option>
            @endforeach

        </select>
    </div>
</div>