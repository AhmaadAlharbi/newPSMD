<div>
    <div>
        <label for=" ssname">يرجى اختيار اسم المحطة</label>
        <input list="ssnames" wire:change="getStationInfo" class="form-control" wire:model="selectedStation" value=""
            name="station_code" id="ssname" type="search">
        <datalist id="ssnames">
            @foreach ($stations as $station)
            <option value="{{ $station->SSNAME }}">
                @endforeach
        </datalist>
        @isset($selectedStation)

        <div class="card bg-gray-100 border
        ">
            <div class="card-body text-center">
                <p class="card-text bg-light
                py-3">{{$stationDetails->fullName}}</p>

                @switch($stationDetails->control)
                @case('JAHRA CONTROL CENTER')
                <p class="bg-warning text-dark text-center py-3">{{$stationDetails->control}}</p>
                @break
                @case('SHUAIBA CONTROL CENTER')
                <p class="bg-success text-white text-center py-3">{{$stationDetails->control}}</p>

                @break
                @case('TOWN CONTROL CENTER')
                <p class="bg-danger text-white text-center py-3">{{$stationDetails->control}}</p>
                @break
                @case('JABRIYA CONTROL CENTER')
                <p class="bg-info text-white text-center py-3">{{$stationDetails->control}}</p>
                @break
                @default
                <p class="{{$selectedStation ? " bg-dark " : " bg-white" }} text-white text-center py-3">
                    {{$stationDetails->control}}
                </p>
                @endswitch
                <div class="border py-3">
                    <p class="card-text">Make : {{$stationDetails->COMPANY_MAKE}}</p>
                    <p class="card-text">Contract.No : {{$stationDetails->Contract_No}}</p>
                    <p class="card-text">Contract.No : {{$stationDetails->COMMISIONING_DATE}}</p>
                </div>
            </div>
        </div>
        @endisset
    </div>
    {{-- <div class="">
        <div>
            <label for="" class=" control-label">Make</label>
            <input id="make" type="text" class="form-control" name="make">
        </div>
        <div>
            <label for="" class="control-label">Last P.M</label>
            <input type="text" class="form-control" name="pm">
        </div>
    </div> --}}
</div>