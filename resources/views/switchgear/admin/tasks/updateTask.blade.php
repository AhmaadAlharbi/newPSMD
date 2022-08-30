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
                {{-- Button trigger modal to change section --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_section">
                    تحويل إلى قسم آخر
                </button>
                {{-- change section modal --}}
                <form action="{{ route('switch.changeSection', ['id' => $tasks->id]) }}">
                    @csrf
                    <div class="modal fade" id="change_section" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">تحويل المهمة لقسم آخر</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if (isset($section))
                                    <select name="section_id" class="form-control" id="">
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    </select>
                                    @else
                                    <select name="section_id" class="form-control" id="">
                                        @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="submit" class="btn btn-primary">إرسال</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- end change section modal --}}

                <form action="{{ route('switch.update', ['id' => $tasks->id]) }}" enctype="multipart/form-data"
                    method="post">
                    {{ csrf_field() }} {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" class="refNum form-control" id="inputName" name="refNum" title=""
                                required value="{{ $tasks->refNum }}" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input type="search" list="ssnames" class="form-control" name="station_code" id="ssname"
                                onchange="getStation(),getEngineer()" value="{{ $tasks->station->SSNAME }}">


                            <datalist id="ssnames">
                                @foreach ($stations as $station)
                                <option value="{{ $station->SSNAME }}">
                                    @endforeach
                            </datalist>


                            <input type="hidden" id="station_id" name="ssnameID" value="{{ $tasks->station->id }}">

                            <input id="staion_full_name" name="staion_full_name" class="text-center p-3 form-control"
                                readonly value="{{ $tasks->station->fullName }}">

                            <input id="control_name" name="control_name" class="text-center   p-3 form-control" readonly
                                value="{{ $tasks->station->control }}">
                        </div>

                        <div class=" col-lg-4">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ $tasks->task_date }}" readonly>
                        </div>
                        {{-- <div class="row m-3">
                            <div class="col-lg-6">
                                <label for="" class="control-label">Make</label>
                                <input id="make" type="text" class="form-control" name="make">
                            </div>
                            <div class="col-lg-6">
                                <label for="" class="control-label">Last P.M</label>
                                <input type="text" class="form-control" name="pm">
                            </div>
                        </div> --}}
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="mainAlarm" class="control-label m-3">Main Alarm</label>
                            <select name="mainAlarm" id="main_alarm" class="form-control">
                                <!--placeholder-->
                                <option value="{{ $tasks->main_alarm }}">{{ $tasks->main_alarm }}</option>

                                <option value="Transformer Tubing SF6 Gas Pressure Low Alarm">Transformer Tubing SF6 Gas
                                    Pressure Low Alarm</option>
                                <option value="Bus Bar SF6 Gas Pressure Low Alarm">Bus Bar SF6 Gas Pressure Low Alarm
                                </option>
                                <option value="Alternating Current Supply Failure Alarm">Alternating Current Supply
                                    Failure Alarm</option>
                                <option value="Main Air tank Pressure Low (Compressed Air Supply Failure) Alarm">Main
                                    Air tank Pressure Low (Compressed Air Supply Failure) Alarm</option>
                                <option value="Door intrusion Detection Alarm">Door intrusion Detection Alarm</option>
                                <option value="General Alarm 33KV">General Alarm 33KV</option>
                                <option value="General Alarm 11KV">General Alarm 11KV</option>
                                <option value="Room Temperature Alarm (SS Control)">Room Temperature Alarm (SS Control)
                                </option>
                                <option value="Bus Bar SF6 Gas Pressure Low Trip">Bus Bar SF6 Gas Pressure Low Trip
                                </option>
                                <option value="Bay SF6 Gas Pressure Low Trip">Bay SF6 Gas Pressure Low Trip</option>
                                <option value="Transformer Tubing SF6 Gas Pressure Low Alarm">Transformer Tubing SF6 Gas
                                    Pressure Low Alarm</option>
                                <option value="Bus Bar SF6 Gas Pressure Low Alarm">Bus Bar SF6 Gas Pressure Low Alarm
                                </option>
                                <option value="Alternating Current Supply Failure Alarm">Alternating Current Supply
                                    Failure Alarm</option>
                                <option value="other">other</option>
                            </select>
                            <input id="other_alarm" name="main_alarm" placeholder="write other main alarm" type="text"
                                class=" invisible form-control" onfocus=this.value=''>
                        </div>
                        <div class="col-lg-6">
                            <label id="voltage" for="Voltage-Level" class=" control-label m-3">Voltage Level</label>

                            <select class="form-control" name="voltage_level" id="equipVoltage"
                                onchange="getEquipNumber()">
                                <option value="{{ $tasks->voltage_level }}">{{ $tasks->voltage_level }}</option>

                            </select>
                            <select name="Voltage_Level" id="voltageLevel" class="form-control d-none">
                                <!--placeholder-->
                                <optgroup>
                                    <option value="{{ $tasks->voltage_level }}">{{ $tasks->voltage_level }}
                                    </option>

                                    <option value="400KV">400KV</option>
                                    <option value="300KV">300KV</option>
                                    <option value="132KV">132KV</option>
                                    <option value="33KV">33KV</option>
                                    <option value="11KV">11KV</option>
                                </optgroup>
                                <optgroup label="General Check">
                                    <option value="132/11KV">132/11KV</option>
                                    <option value="33/11KV">33/11KV</option>
                                    <option value="400/132/11KV">400/132/11KV</option>
                                    <option value="300/132/11KV">300/132/11KV</option>
                                </optgroup>

                            </select>
                        </div>
                    </div>
                    <div class="row m-3">

                        <div class="col-lg-6">
                            <label for="equip" class="control-label m-1">equip Number</label>
                            <select type="text" id="equipNumber" name="equip_number" class="form-control"
                                onchange=" getEquipName()">
                                <option value="{{ $tasks->equip_number }}">{{ $tasks->equip_number }}</option>
                            </select>
                            <input type="text" class="form-control d-none" id="inputEquipNumber" value={{
                                $tasks->equip_number }}>

                        </div>

                        <div class="col-lg-6">
                            <label for="equip" class="control-label m-1">equip name</label>
                            <!-- <select type="text" name="equip" id="equipName" class="form-control "></select> -->
                            <input style="direction:ltr;" type="text" name="equip_name" id="equipName"
                                class="form-control text-center " value="{{ $tasks->equip_name }}">


                        </div>

                        <div class="col-lg-12">
                            <label for="problem" class="control-label m-1"> Nature of Fault</label>
                            <textarea list="problems" class="form-control" name="problem"
                                id="problem">{{ $tasks->problem }} </textarea>

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
                                <option value="{{ $tasks->work_type }}">{{ $tasks->work_type }}</option>
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
                            <select name="shift" id="shiftSelect" class="form-control " onchange="getEngineersShift()">
                                <!--placeholder-->
                                <option value="0"> صباحاً </option>
                                <option value="1"> مساءً </option>
                            </select>


                        </div>

                        <div class="col">

                            <label for="inputName" class="control-label">اسم المهندس</label>
                            <select id="eng_name" name="eng_name" class="form-control engineerSelect"
                                onchange="getEngineerEmail()">
                                @unless($tasks->eng_id == null)
                                <option value="{{ $tasks->users->id }}">{{ $tasks->users->name }}</option>
                                @endunless
                            </select>
                        </div>
                        <div class=" col email">
                            <label for="inputName" class="control-label"> Email</label>

                            @if ($tasks->eng_id == null)
                            <input type="text" class="form-control" name="eng_email" id="eng_name_email">
                            @else
                            <input type="text" class="form-control" name="eng_email" id="eng_name_email"
                                value="{{ $tasks->users->email }}">
                            @endif
                        </div>


                    </div>



                    {{-- 6 --}}
                    <div class="row m-3">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="notes"
                                rows="3">{{ $tasks->notes }}</textarea>
                        </div>
                    </div><br>

                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">المرفقات</h5>
                    {{-- show Attahcments --}}
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
                                        @if ($attachment->Created_by == '')
                                        {{ $task->engineers->name }}
                                        @else
                                        {{ $attachment->Created_by }}
                                        @endif
                                    </td>
                                    <td colspan="2">

                                        <a class="btn btn-outline-success btn-sm"
                                            href="{{ route('switch.view_file', ['id' => $attachment->id_task, 'file_name' => $attachment->file_name]) }}"
                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                            عرض</a>

                                        <a class="btn btn-outline-info btn-sm"
                                            href="{{ route('switch.download_file', ['id' => $attachment->id_task, 'file_name' => $attachment->file_name]) }}"
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
                    @foreach ($task_attachments as $x)
                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                    </div><br>
                    @endforeach
                    {{-- <div class="col-sm-12 col-md-12">
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
                    </div> --}}
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

<script type="text/javascript" src="{{ URL::asset('js/switchgear/updateTask.js') }}"></script>

@endsection