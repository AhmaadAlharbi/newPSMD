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
                -اضافة مهمة - قسم الوقاية</span>
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
                <form action="{{route('edara.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" id="refNum" class=" form-control" id="inputName" name="refNum" title=""
                                required value="{{ date('y-m') }}/{{$task_id}}" readonly>
                            <input type="hidden" name="task_id" value="{{$task_id}}">
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input list="ssnames" class="form-control" value="" name="station_code" id="ssname"
                                onchange="getStation()">
                            <datalist id="ssnames">
                                @foreach($stations as $station)
                                <option value="{{$station->SSNAME}}">
                                    @endforeach
                            </datalist>
                            <input id="staion_full_name" name="staion_full_name"
                                class="text-center d-none p-3 form-control" readonly>
                            <input id="control_name" name="control_name" class="text-center d-none  p-3 form-control"
                                readonly>
                            <input type="hidden" id="station_id" name="ssnameID">
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

                    <div class="row m-3">
                        <div class="col-lg-12">
                            <label for="equip" class="control-label m-1">main alarm</label>
                            <input id="main_alarm" type="text" name="main_alarm" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label for="equip" class="control-label m-1">Bay Unit</label>
                            <input id="equip" type="text" name="equip" class="form-control SlectBox">
                        </div>
                        <div class="col-lg-12">
                            <label for="problem" class="control-label m-1"> Nature of Fault</label>
                            <textarea list="problems" class="form-control" name="problem" id="problem"></textarea>
                        </div>
                    </div>
                    {{-- 3 --}}
                    <div class="row m-3">
                        <div class="col-lg-12">
                            <label for="section" class="control-label">القسم</label>
                            <select name="section" id="section" class="form-control">
                                @foreach($sections as $section)
                                <option value="{{$section->id}}">{{$section->section_name}}</option>
                                @endforeach
                            </select>
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
                            data-target="#exampleModal">ارسال البيانات</button>
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

<!--PROTECTION JS fiLE-->
<script type="text/javascript" src="{{ URL::asset('js/edara/app.js') }}"></script>


@endsection