<div class="col-12 my-2">

    <label for="">المحطة</label>
    <input list="ssnames" wire:change="getVoltage" class="form-control mb-3" value="" wire:model="selectedStation"
        name="station_code" id="ssname" onchange="getStation()" type="search">
    <datalist id="ssnames">
        @foreach ($stations as $station)
        <option value="{{ $station->SSNAME }}">
            @endforeach
    </datalist>

    @isset($selectedStation)
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
    <div class="col-12 mt-3">
        <label for="">Main Alarm</label>
        <select name="mainAlarm" id="main_alarm" class="form-control">
            <!--placeholder-->
            <option value="Auto reclosure">Auto reclosure</option>
            <option value="Flag Relay Replacement">Flag Relay Replacement </option>
            <option value="Protection Clearance feeder">Protection Clearance feeder</option>
            <option value="Transformer Clearance">Transformer Clearance</option>
            <option value="mw reading wrong transformer">mw reading wrong transformer</option>
            <option value="mv reading wrong transformer">mv reading wrong transformer</option>
            <option value="kv reading wrong transformer">kv reading wrong transformer</option>
            <option value="Dist Prot Main Alaram">Dist Prot Main Alaram</option>
            <option value="Dist.Prot.Main B Alarm">Dist.Prot.Main B Alarm</option>
            <option value="Pilot Cable Fault Alarm">Pilot Cable Fault Alarm</option>
            <option value="Pilot cable Superv.Supply Fail Alarm">Pilot cable Superv.Supply Fail
                Alarm</option>
            <option value="mw reading showing wrong">mw reading showing wrong</option>
            <option value="mv reading showing wrong">mv reading showing wrong</option>
            <option value="kv reading showing wrong">kv reading showing wrong</option>
            <option value="ampere reading showing wrong">ampere reading showing wrong</option>
            <option value="BB reading showing wrong">BB reading showing wrong</option>
            <option value="BB KV reading showing wrong">BB KV reading showing wrong</option>
            <option value="Transformer out of step Alarm">Transformer out of step Alarm</option>
            <option value="DC Supply 1 & 2 Fail Alarm">DC Supply 1 & 2 Fail Alarm</option>
            <option value="Communication Fail Alarm">Communication Fail Alarm</option>
            <option value="General Alarm 300KV">General Alarm 300KV</option>
            <option value="General Alarm 132KV">General Alarm 132KV</option>
            <option value="General Alarm 33KV">General Alarm 33KV</option>
            <option value="General Alarm 11KV">General Alarm 11KV</option>
            <option value="B/Bar Protection Fail Alarm">B/Bar Protection Fail Alarm</option>
            <option value="Shunt Reactor Restricted Earth Earth Fault Realy">Shunt Reactor
                Restricted Earth Earth Fault Realy</option>
            <option value="Shunt Reactor Over Current">Shunt Reactor Over Current</option>
            <option value="Shunt Reactor Clearance">Shunt Reactor Clearance</option>

            <option value="Shunt Reactor Earth Fault">Shunt Reactor Earth Fault</option>
            <option value="Breaker Open / close undefined">Breaker Open / close undefined
            </option>
            <option value="B/Bar Isolator open / close D.S">B/Bar Isolator open / close D.S
            </option>
            <option value="B/Bar Isolator open / close D.S">Line Isolator Open / close D.S
            </option>
            <option value="other">other</option>
        </select>
    </div>
    @endisset
    @if(Route::is('users.show') )
    // true
    @endif

</div>