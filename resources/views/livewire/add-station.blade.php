<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div>
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="text-center ">
            <label for=" ssname">يرجى اختيار اسم المحطة</label>
            @if($selectedStation == null)

            <input list="ssnames" wire:change="getStationInfo" class="form-control " wire:model="selectedStation" name="selectedStation" id="ssname" type="search">
            @else
            <input list="ssnames" wire:change="getStationInfo" class="form-control  {{$stationDetails  ? " is-valid"
                : " is-invalid" }}" wire:model="selectedStation" name="station_code" id="ssname" type="search">

            @endif

            <datalist id="ssnames">
                @foreach ($stations as $station)
                <option value="{{ $station->SSNAME }}">
                    @endforeach
            </datalist>
            @error('selectedStation') <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div> @enderror

            <div class="invalid-feedback ">
                <p class="h6">Please select the station from the list or contact admins to add a new station</p>
            </div>
            @isset($stationDetails)
            <div class="card bg-gray-100 border
        ">
                <div class="card-body text-center">
                    <p class="card-text bg-light
                py-3">{{$stationDetails->fullName}}</p>

                    <ul class="list-group ">
                        @switch($stationDetails->control)

                        @case('JAHRA CONTROL CENTER')
                        {{-- <p class="bg-warning text-dark text-center py-3">{{$stationDetails->control}}</p> --}}
                        <li class="list-group-item list-group-item-warning  font-italic ">{{$stationDetails->control}}
                        </li>

                        @break
                        @case('SHUAIBA CONTROL CENTER')
                        <li class="list-group-item list-group-item-success  font-italic ">{{$stationDetails->control}}
                        </li>
                        @break
                        @case('TOWN CONTROL CENTER')
                        <li class="list-group-item list-group-item-danger  font-italic ">{{$stationDetails->control}}
                        </li>
                        @break
                        @case('JABRIYA CONTROL CENTER')
                        <li class="list-group-item list-group-item-info  font-italic ">{{$stationDetails->control}}</li>
                        @break
                        @default
                        <li class="{{$selectedStation ? " list-group-item list-group-item-dark font-italic"
                            : " bg-white" }} ">
                            {{$stationDetails->control}}
                        </li>
                        @endswitch
                    </ul>

                    <ul class=" list-group ">


                        <li class=" list-group-item disabled font-italic list-group-item-secondary">Make :
                            {{$stationDetails->COMPANY_MAKE}}
                        </li>
                        <li class="list-group-item font-italic disabled  list-group-item-secondary">Contract.No :
                            {{$stationDetails->Contract_No}}
                        </li>
                        <li class="list-group-item font-italic disabled  list-group-item-secondary">COMMISIONING DATE :
                            {{$stationDetails->COMMISIONING_DATE}}
                        </li>

                    </ul>

                </div>
                <div class="col-12">
                    <label for="main_alarm" class="control-label m-3">Main Alarm</label>
                    <select wire:model="main_alarm" wire:change="getEquip" name="mainAlarm" id="main_alarm" class="form-control">
                        <!--placeholder-->
                        <option value="-">-</option>
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
                    <label class="my-2">Voltage</label>
                    <select wire:model="selectedVoltage" wire:change="getEquip" class="form-control mb-3" name="equip_name" id="">
                        <option value="-1">Please select Voltage</option>
                        {{-- <option value="{{$selectedVoltage}}">{{$selectedVoltage}}</option> --}}
                        @foreach($voltage as $v)
                        <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label for="">Equip </label>

                    <select wire:model="selectedEquip" class="form-control mb-3" name="equip_name">
                        <option value="-1">Please select Equip</option>

                        @foreach($equip as $equip)
                        <option value="{{$equip->equip_number}} - {{$equip->equip_name}}">{{$equip->equip_number}} -
                            {{$equip->equip_name}}
                        </option>
                        @endforeach

                    </select>
                </div>

                @endisset


                <div class="">
                    <label for="inputName" class="control-label">اسم المهندس</label>
                    <select wire:model="selectedEngineer" id="eng_name" wire:change="getEmail" name="eng_name" class="form-control engineerSelect my-4">
                        <option value="">-</option>
                        @foreach($engineers as $engineer)
                        <option value="{{$engineer->users->id}}">{{$engineer->users->name}}</option>
                        {{-- <option value="{{$engineer->id}}">{{$engineer->id}}</option> --}}
                        @endforeach
                    </select>
                    <div class="form-check mb-4">
                        <input wire:model="duty" wire:change="getEngineer" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label mx-3" for="defaultCheck1">
                            Duty Engineers
                        </label>
                    </div>
                </div>
                <div class="  email">
                    {{-- <label for="inputName" class="control-label"> Email</label> --}}

                    <input wire:model="engineerEmail" type="text" class="form-control" name="eng_email" id="eng_name_email" readonly>
                </div>
                <label for="" class="mt-2">نوع المهمة</label>
                <select name="" wire:model="work_type" id="" class="form-control">
                    <option value="">-</option>
                    <option value="Clearance">Clearance</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Inspection">Inspection</option>
                    <option value="outage">outage</option>
                    <option value="Installation">Installation</option>
                    <option value="other">other</option>
                </select>
                <label for="problem" class="control-label mt-4"> Nature of Fault</label>
                <textarea list="problems" wire:model="problem" class="form-control " rows="3" name="problem" id="problem"></textarea>
                <label for="exampleTextarea" class="mt-3">ملاحظات</label>
                <textarea class="form-control" id="exampleTextarea" name="notes" rows="3"></textarea>
                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                <h5 class="card-title">المرفقات</h5>
                @error('photos.*') <span class="alert alert-danger">{{ $message }}</span> @enderror

                <div class="col-sm-12 col-md-12">
                    <input type="file" wire:model="photos" multiple>

                    <div wire:loading wire:target="photos">Uploading...</div>

                    <!-- <input type="file" wire:model="files" multiple /> -->
                </div><br>

                <!-- <div class="col-sm-12 col-md-12">
                    <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />

                </div><br> -->
                <br>
                <div class="text-center mb-3">
                    <button id="showAttachment" class="btn btn-outline-info">اضغط لإضافة المزيد من
                        المرفقات</button>
                    <button id="hideAttachment" class="btn d-none btn-outline-info">اضغط  لإخفاء المزيد من
                        المرفقات</button>

                </div>
                <div id="attachmentFile" class="d-none">
                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                    </div><br>
                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                    </div><br>
                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                    </div><br>
                </div>



                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModals">ارسال
                        البيانات</button>
                </div>
            </div>
        </div>
    </form>
</div>