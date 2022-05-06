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
                -اضافة تقرير - قسم الوقاية</span>
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
                <form action="{{route('proteciton.SubmitEngineerReport',['id'=>$task->id])}}" method="post"
                    enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" id="refNum" class=" form-control" id="inputName" name="refNum" title=""
                                required value="{{$task->refNum}}" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname"> اسم المحطة</label>
                            <input list="ssnames" class="form-control" name="station_code" id="ssname"
                                value="{{$task->station->SSNAME}}" readonly>

                            <input id="staion_full_name" name="staion_full_name" class="text-center  p-3 form-control"
                                value="{{$task->station->fullName}}" readonly>
                            <input id="control_name" name="control_name" class="text-center   p-3 form-control"
                                value="{{$task->station->control}}" readonly>
                        </div>
                        <div class=" col-lg-4">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{$task->task_date}}" readonly>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="" class="control-label">Make</label>
                            <input id="make" type="text" class="form-control" name="make"
                                value="{{$task->station->COMPANY_MAKE}}" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="control-label">Last P.M</label>
                            <input type="text" class="form-control" name="pm" readonly>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="main-alarm" class="control-label m-3">Main Alarm</label>
                            <input type="text" class="form-control" value="{{$task->main_alarm}}" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label id="voltage" for="Voltage-Level" class=" control-label m-3">Voltage Level</label>
                            <input type="text" class="form-control" value="{{$task->voltage_level}}" readonly>

                        </div>
                    </div>
                    <div class="row m-3">

                        <div class="col-lg-6">
                            <label for="equip" class="control-label m-1">Bay Unit</label>
                            <input id="equip" type="text" name="equip" class="form-control SlectBox"
                                value="{{$task->equip}}" readonly>
                        </div>

                        <div class="col-lg-6">
                            <label for="problem" class="control-label m-1"> Nature of Fault</label>
                            <textarea name="problem" readonly id="problem" cols="30" rows="10" class="form-control">
                                {{$task->problem}}
                            </textarea>

                        </div>
                    </div>




                    {{-- 2 --}}
                    <div class="row m-3">
                        <div class="col border border-warning p-3 flex-wrap">
                            <h6 class="text-warning">Work Type</h6>
                            <input type="text" readonly class="form-control" value="{{$task->work_type}}">

                        </div>
                    </div>

                    {{-- 3 --}}

                    <div class="row m-3">

                        <div class="col">
                            <label for="inputName" class="control-label">اسم المهندس</label>
                            <input type="text" readonly class="form-control" value="{{$task->engineers->name}}">
                        </div>


                    </div>



                    {{-- 6 --}}
                    <div class="row m-3">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" readonly id="exampleTextarea" name="notes" rows="3">
                                {{$task->notes}}
                            </textarea>
                        </div>
                    </div><br>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                        لم يتم الإنجاز؟
                    </button>

                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Action Take</label>
                            <textarea required class="form-control" id="exampleTextarea" name="action_take"
                                rows="3"></textarea>
                        </div>

                    </div>
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


                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">ارسال البيانات</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> سبب عدم الإنجاز </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{route('proteciton.engineerReportUnCompleted',['id'=>$task->id])}}" method="post">
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1"> اختر السبب</label>
                    <select name="reason" class="form-control" id="exampleFormControlSelect1">
                        <option value="مسؤولية جهة آخرى">مسؤولية جهة آخرى</option>
                        <option value="تحت الكفالة">تحت الكفالة</option>
                        <option value="قطع غيار غير متوفرة "> قطع غيار غير متوفرة </option>
                        <option value="بإنتظار إصلاحات"> بإنتظار إصلاحات</option>
                        <option value="تحويل المهمة لمهندس آخر">تحويل المهمة لمهندس آخر </option>
                        <option value="آخرى"> آخرى</option>
                    </select>
                    <!--Take all these hidden value to the form-->
                    <input type="hidden" class="form-control" id="inputName" name="refNum" value="" readonly>
                    <input type="hidden" class="form-control" readonly name="ssname" id="ssname" value="">
                    <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD" type="hidden"
                        value="" readonly required>
                    <input type="hidden" class="form-control" readonly name="equip" id="equip" value="">
                    <input type="hidden" class="form-control" readonly value="" name="problem" id="problem">
                    <input class="form-control fc-datepicker" name="report_Date" placeholder="YYYY-MM-DD" type="hidden"
                        value="" readonly required>
                    <input type="hidden" class="form-control" name="eng_name" readonly value="">
                    <textarea type="hidden" style="display:none;" class="form-control" id="exampleTextarea" name="notes"
                        readonly rows="3"></textarea>
                    <!--END Taking all these hidden value to the form-->

                    <label for="exampleTextarea">ملاحظات</label>
                    <textarea class="form-control" id="exampleTextarea" name="engineer_note" rows="3"></textarea>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>

        </div>

        <!-- row closed -->
    </div>
    <!-- Container closed -->
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
<script>
const controlName = document.querySelector('#control_name');

//colored control name
switch (controlName.value) {
    case "SHUAIBA CONTROL CENTER":
        controlName.classList.add('form-control', 'text-center', 'bg-success', 'text-light');
        area_select_option.text = 'المنطقة الجنوبية';
        area_select_option.value = 2;
        areaSelect.add(area_select_option);
        break;
    case "JABRIYA CONTROL CENTER":
        controlName.classList.add('form-control', 'text-center', 'bg-info', 'text-light');
        area_select_option.text = 'المنطقة الجنوبية';
        area_select_option.value = 2;
        areaSelect.add(area_select_option);
        break;
    case "JAHRA CONTROL CENTER":
        controlName.classList.add('form-control', 'text-center', 'bg-warning', 'text-light');
        area_select_option.text = 'المنطقة الشمالية';
        area_select_option.value = 1;
        areaSelect.add(area_select_option);
        break;
    case "TOWN CONTROL CENTER":
        controlName.classList.add('form-control', 'text-center', 'bg-danger', 'text-light');
        area_select_option.text = 'المنطقة الشمالية';
        area_select_option.value = 1;
        areaSelect.add(area_select_option);
        break;
    case "NATIONAL CONTROL CENTER":
        controlName.classList.add('form-control', 'text-center', 'bg-dark', 'text-light');
        area_select_option.text = 'المنطقة الشمالية';
        area_select_option.value = 1;
        areaSelect.add(area_select_option);
        area_select_option2.text = 'المنطقة الجنوبية';
        area_select_option2.value = 2;
        areaSelect.add(area_select_option2);
        break;

} //switch end
</script>

@endsection