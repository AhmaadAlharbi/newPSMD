@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
تعديل فاتورة
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تعديل مهمة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">


                <form action="{{route('protection.update',['id'=>$tasks->id])}}" enctype="multipart/form-data"
                    method="post">
                    {{ csrf_field() }} {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" class="refNum form-control" id="inputName" name="refNum" title=""
                                required value="{{$tasks->refNum}}" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input list="ssnames" class="form-control" name="station_code" id="ssname"
                                onchange="getStation(),getEngineer()" value="{{$tasks->station->SSNAME}}">


                            <datalist id="ssnames">
                                @foreach($stations as $station)
                                <option value="{{$station->SSNAME}}">
                                    @endforeach
                            </datalist>


                            <input type="hidden" id="station_id" name="ssnameID" value="{{$tasks->station->id}}">

                            <input id="staion_full_name" name="staion_full_name" class="text-center p-3 form-control"
                                readonly value="{{$tasks->station->fullName}}">

                            <input id="control_name" name="control_name" class="text-center   p-3 form-control" readonly
                                value="{{$tasks->station->control}}">
                        </div>

                        <div class=" col-lg-4">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{$tasks->task_date}}" readonly>
                        </div>
                        <div class="row m-3 d-none">
                            <div class="col-lg-6">
                                <label for="" class="control-label ">Make</label>
                                <input id="make" type="text" class="form-control" name="make">
                            </div>
                            <div class="col-lg-6">
                                <label for="" class="control-label ">Last P.M</label>
                                <input type="text" class="form-control" name="pm">
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="mainAlarm" class="control-label m-3">Main Alarm</label>
                            <select name="mainAlarm" id="main_alarm" class="form-control">
                                <!--placeholder-->
                                <option value="{{$tasks->main_alarm}}">{{$tasks->main_alarm}}</option>

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
                            <input id="other_alarm" name="main_alarm" placeholder="write other main alarm" type="text"
                                class=" invisible form-control" onfocus=this.value=''>
                        </div>
                        <div class="col-lg-6">
                            <label id="voltage" for="Voltage-Level" class=" control-label m-3">Voltage Level</label>
                            <select name="Voltage_Level" id="voltageLevel" class="form-control">
                                <!--placeholder-->
                                @if(!$tasks->main_alarm == "Transformer Clearance" || "Shunt Reactor Clearance")
                                <option value="{{$tasks->Voltage_level}}">{{$tasks->Voltage_level}}</option>
                                @endif
                                <option value="400KV">400KV</option>
                                <option value="300KV">300KV</option>
                                <option value="132KV">132KV</option>
                                <option value="33KV">33KV</option>
                                <option value="11KV">11KV</option>

                            </select>
                            <select id="transformerVoltage" class="d-none form-control">
                                <!--placeholder-->
                                @if($tasks->main_alarm == "Transformer Clearance")
                                <option value="{{$tasks->Voltage_level}}">{{$tasks->Voltage_level}}</option>
                                @endif
                                <option value="750MVA">750MVA</option>
                                <option value="300MVA">300MVA</option>
                                <option value="75MVA">75MVA</option>
                                <option value="45MVA">45MVA</option>
                                <option value="30MVA">30MVA</option>
                                <option value="20MVA">20MVA</option>
                                <option value="15MVA">15MVA</option>
                                <option value="10MVA">10MVA</option>
                                <option value="7.5MVA">7.5MVA</option>
                                <option value="5MVA">5MVA</option>

                            </select>
                            <select id="shuntVoltage" class="d-none form-control">
                                <!--Placeholder-->
                                @if($tasks->main_alarm == "Shunt Reactor Clearance")
                                <option value="{{$tasks->Voltage_level}}">{{$tasks->Voltage_level}}</option>
                                @endif
                                <option value="250MVAR">250MVAR</option>
                                <option value="125MVAR">125MVAR</option>
                                <option value="50MVAR">50MVAR</option>
                                <option value="45MVAR">45MVAR</option>
                                <option value="30MVAR">30MVAR</option>
                            </select>

                            <select id="dist" class="d-none form-control">
                                <!--placeholder-->
                                <option value="400KV">400KV</option>
                                <option value="300KV">300KV</option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3">

                        <div class="col-lg-6">
                            <label for="equip" class="control-label m-1">Bay Unit</label>
                            <input type="text" name="equip" class="form-control SlectBox" value="{{$tasks->equip}}">

                        </div>

                        <div class="col-lg-6">
                            <label for="problem" class="control-label m-1"> Nature of Fault</label>
                            <input list="problems" class="form-control" name="problem" id="problem"
                                value="{{$tasks->problem}}">

                            <datalist id="problems">

                            </datalist>
                        </div>
                    </div>




                    {{-- 2 --}}
                    <div class="row m-3">
                        <div class="col border border-warning p-3 flex-wrap">
                            <h6 class="text-warning">Work Type</h6>
                            <select id="Work_type" name="work_type" class="form-control">
                                <!--Placeholder-->
                                <option value="{{$tasks->work_type}}">{{$tasks->work_type}}</option>
                                <option value="Inspection">Inspection</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Troubleshooting">Troubleshooting</option>
                                <option value="outage">Installation</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>

                    {{-- 3 --}}

                    <div class="row m-3">
                        <div class="col-lg-3">
                            <label for="area" class="control-label">area</label>
                            <select name="area" id="areaSelect" class="form-control areaSelect"
                                onchange="getEngineer()">




                            </select>
                        </div>


                        <div class="col-lg-3">
                            <label for="shift" class="control-label">shif</label>
                            <select name="shift" id="shiftSelect" class="form-control " onchange="shiftEngineer()">
                                <!--placeholder-->

                                <option value="1"> مساءً </option>
                                <option value="0"> صباحاً </option>
                            </select>


                        </div>

                        <div class="col">
                            <button id="changeEngineerButton" class="btn btn-outline-info btn-sm ml-2">تغيير اسم
                                المهندس</button>
                            <label for="inputName" class="control-label">اسم المهندس</label>
                            <select id="eng_name" name="eng_name" class="form-control engineerSelect"
                                onchange="getEngineerEmail()">
                                @unless($tasks->eng_id == null)
                                <option value="{{$tasks->users->id}}">{{$tasks->users->name}}</option>
                                @endunless
                            </select>
                        </div>
                        <div class=" col email">
                            <label for="inputName" class="control-label"> Email</label>
                            @if($tasks->eng_id == null)
                            <input type="text" class="form-control" name="eng_email" id="eng_name_email">
                            @else
                            <input type="text" class="form-control" name="eng_email" id="eng_name_email"
                                value="{{$tasks->users->email }}">
                            @endif


                        </div>


                    </div>



                    {{-- 6 --}}
                    <div class="row m-3">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="notes"
                                rows="3">{{$tasks->notes}}</textarea>
                        </div>
                    </div><br>

                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">المرفقات</h5>
                    {{--show Attahcments --}}
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table mb-0  table-hover" style="text-align:center">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">م</th>
                                    <th scope="col">اسم الملف</th>
                                    <th scope="col">تاريخ الاضافة</th>
                                    <th scope="col"> بواسطة</th>
                                    <th scope="col">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($task_attachments as $attachment)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $attachment->file_name }}</td>
                                    <td>{{ $attachment->created_at }}</td>
                                    <td>
                                        @if($attachment->Created_by =="")
                                        {{$task->engineers->name}}
                                        @else
                                        {{ $attachment->Created_by }}
                                        @endif
                                    </td>
                                    <td colspan="2">

                                        <a class="btn btn-outline-success btn-sm"
                                            href="{{route('protection.view_file',['id'=> $attachment->id_task,'file_name'=>$attachment->file_name])}}"
                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                            عرض</a>

                                        <a class="btn btn-outline-info btn-sm"
                                            href="{{route('protection.download_file',['id'=> $attachment->id_task,'file_name'=>$attachment->file_name])}}"
                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                            تحميل</a>

                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                            data-file_name="{{ $attachment->file_name }}"
                                            data-invoice_number="{{ $attachment->id_task }}"
                                            data-id_file="{{ $attachment->id }}" data-target="#delete_file">حذف</button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                    </div><br>
                    {{--<div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />

                    </div><br>
                     <div class="text-center mb-3">
                        <button id="showAttachment" class="btn btn-outline-info">اضغط لإضافة المزيد من
                            المرفقات</button>
                        <button id="hideAttachment" class="btn d-none btn-outline-info">اضغط  لإخفاء المزيد من
                            المرفقات</button>

                    </div>
                    <div id="attachmentFile" class="d-none">
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>
                    </div>--}}
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">ارسال البيانات</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
var date = $('.fc-datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
}).val();
</script>

<script type="text/javascript" src="{{ URL::asset('js/protection/updateTask.js') }}"></script>

@endsection