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
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                -اضافة مهمة - قسم البطاريات</span>
        </div>
    </div>
</div>
@endsection
@section('content')

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-solid-danger mg-b-0">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card border border-primary">
            <div class="card-body">
            {{-- Button trigger modal to change section --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_section">
                تحويل إلى قسم آخر
            </button>
            {{--change section modal --}}
         <form action="{{route('transformers.changeSection',['id'=>$tasks->id])}}">
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
                                    @if(isset($section))
                                    <select name="section_id" class="form-control" id="">
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    </select>
                                    @else
                                    <select name="section_id" class="form-control" id="">
                                        @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="submit" class="btn btn-primary">إرسال</button>
                                </div>
                            </div>
                        </div>
                    </div>
         </form>
                {{--end change section modal --}}
                <form action="{{route('Transformers.update',['id'=>$tasks->id])}}" method="post"
                    enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" class="refNum form-control" id="inputName" name="refNum" title=""
                                required value="{{$tasks->refNum}}" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input list="ssnames" class="form-control" name="station_code" id="ssname"
                                onchange="getStation(),getAdmins()" value="{{$tasks->station->SSNAME}}">
                            <datalist id="ssnames">
                                @foreach($stations as $station)
                                <option value="{{$station->SSNAME}}">
                                    @endforeach
                            </datalist>
                            <input type="hidden" id="station_id" name="ssnameID" value="{{$tasks->station->id}}">

                            <input id="staion_full_name" name="staion_full_name"
                                class="text-center d-none p-3 form-control" readonly>
                            <input id="control_name" name="control_name" class="text-center   p-3 form-control" readonly
                                value="{{$tasks->station->control}}">
                        </div>
                        <div class=" col-lg-4">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="" class="control-label">Make</label>
                            <input id="make" type="text" class="form-control" name="make">
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="control-label">Last P.M</label>
                            <input type="text" class="form-control" name="pm">
                        </div>
                    </div>
                    <div class="row m-3 bg-warning pb-2">
                        <div class="col-lg-6">
                            <label for="department" class="control-label m-3">Department</label>
                            <select name="department" id="department" class="form-control "
                                onChange="checkDepartment() ,getAdmins()">
                                <!--placeholder-->
                                @empty($tr_task)
                                <option value="1">Mechanical</option>
                                <option value="2">Chemistry</option>
                                <option value="3">Electrical</option>
                                @endempty
                              @isset($tr_task)
                                @if($tr_task->department == 1)
                                <option value="1">Mechanical</option>
                                <option value="2">Chemistry</option>
                                <option value="3">Electrical</option>
                                @elseif($tr_task->department==2)
                                <option value="2">Chemistry</option>
                                <option value="1">Mechanical</option>
                                <option value="3">Electrical</option>
                                @else
                                <option value="3">Electrical</option>
                                <option value="1">Mechanical</option>
                                <option value="2">Chemistry</option>
                                @endif
                                @endisset
                              
                            </select>
                        </div>
                        @if($tr_task === null || $tr_task->department == 1)
                        <div class=" col-lg-6  " id="main_alarm">
                            <label for="main_alarm" class="control-label m-3">Main Alarm</label>
                            <select name="mainAlarm" class="form-control">
                                <option value="Fan Trouble alarm">Fan Trouble alarm</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    {{-- 2 --}}
                    <!--Work type for Mechinacl-->
                    <div class="row m-3 d-none " id="workType-MechDiv">
                        <div class="col border border-warning p-3 flex-wrap">
                            <h6 class="text-warning">Work Type</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  checkbox" type="radio" name="work_type"
                                    id="inlineRadio1" value="TroubleShooting" onClick="checkBoxMech('TroubleShooting')">
                                <label class="form-check-label  m-2" for="inlineRadio1">TroubleShooting</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio2"
                                    value="Maintenance" onClick="checkBoxMech('Maintenance')">
                                <label class="form-check-label m-2" for="inlineRadio2">Maintenance</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio3"
                                    value="Inspection" onClick="checkBoxMech('Inspection')">
                                <label class="form-check-label m-2" for="inlineRadio3">Inspection</label>
                            </div>

                        </div>
                    </div>
                    <!--Work type for chemestry-->
                    <div class="row m-3 d-none" id="workType-ChemDiv">
                        <div class="col border border-warning p-3 flex-wrap">
                            <h6 class="text-warning">Work Type</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  checkbox" type="radio" name="work_type"
                                    id="inlineRadio1" value="Emergency" onClick="checkBoxFunc('Emergency')">
                                <label class="form-check-label  m-2" for="inlineRadio1">Emergency</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio2"
                                    value="Maintenance" onClick="checkBoxFunc('Maintenance')">
                                <label class="form-check-label m-2" for="inlineRadio2">Maintenance</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio3"
                                    value="Inspection" onClick="checkBoxFunc('Inspection')">
                                <label class="form-check-label m-2" for="inlineRadio3">Inspection</label>
                            </div>

                        </div>
                    </div>
                    <div class="row m-3  d-none " id="alarm">
                        <label for="mechanical" id="section-label">Mechanical Alarm</label>
                        <select name="work_type_description" class="form-control d-none" id="MechAlarmSelect">

                        </select>
                        <select name="work_type_description" class="form-control d-none" id="chemistryAlarm">

                        </select>
                    </div>
                    {{-- 3 --}}

                    <div class="row m-3">
                        <div class="col-lg-3">
                            <label for="inputName" class="control-label">المنطقة</label>
                            <select name="area" id="areaSelect" class="form-control areaSelect">
                                <!--placeholder-->
                                <!-- <option value="1"> المنطقة الشمالية</option>
                                <option value="2"> المنطقة الجنوبية</option> -->

                            </select>
                        </div>

                        <div class="col-lg-3">
                            <label for="inputName" class="control-label">shif</label>
                            <select name="shift" id="shiftSelect" class="form-control SlectBox" onchange="">
                                <!--placeholder-->
                                <option value="0"> صباحاً </option>
                                <option value="0"> مساءً </option>
                            </select>

                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">اسم المهندس</label>
                            <select id="eng_name" name="eng_name" class="form-control engineerSelect"
                                onchange="getEngineerEmail()">
                                @unless($tasks->eng_id == null)
                                <option value="{{$tasks->eng_id}}">{{$tasks->users->name}}</option>
                                @endunless
                            </select>
                        </div>
                        <div class="col mt-3">
                            <button id="changeAdminButton" class="btn btn-info btn-sm">
                                تحويل إلى مشرف
                            </button>
                            <button id="changeEngineerButton" class="btn btn-outline-info btn-sm mt-2">
                                تحويل إلى مهندس
                            </button>
                        </div>
                        <div class=" col email d-none ">
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
                            <textarea class="form-control" id="exampleTextarea" name="notes" rows="3"></textarea>
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
                                            href="{{route('transformers.view_file',['id'=> $attachment->id_task,'file_name'=>$attachment->file_name])}}"
                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                            عرض</a>

                                        <a class="btn btn-outline-info btn-sm"
                                            href="{{route('transformers.download_file',['id'=> $attachment->id_task,'file_name'=>$attachment->file_name])}}"
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

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />

                    </div><br>
                    <br>
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
                    </div>



                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">ارسال
                            البيانات</button>
                    </div>




                </form>
            </div>

        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

@endsection
@section('js')
<script>
var date = $('.fc-datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
}).val();
</script>

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

<!--BATTERY JS fiLE-->
<script type="text/javascript" src="{{ URL::asset('js/transformers/updateTask.js') }}"></script>


@endsection