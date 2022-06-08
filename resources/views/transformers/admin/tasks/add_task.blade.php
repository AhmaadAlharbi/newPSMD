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
    <style>
        /** LOADING */
        .loader {
            color: #ffb300;
            font-size: 90px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            margin: 72px auto;
            position: relative;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            animation: load6 1.7s infinite ease, round 1.7s infinite ease;
        }

        @-webkit-keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }

            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }

            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }

            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }

        @keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }

            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }

            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }

            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }

        @-webkit-keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    -اضافة مهمة - قسم المحولات</span>
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
                    <form action="{{ route('Transformers.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row m-3">
                            <div class="col-lg-4">
                                <label for="inputName" class="control-label">رقم التقرير</label>
                                <input type="text" id="refNum" class=" form-control" id="inputName" name="refNum" title=""
                                    required value="{{ date('y-m') }}/{{ $task_id }}" readonly>
                                <input type="hidden" name="task_id" value="{{ $task_id }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="ssname">يرجى اختيار اسم المحطة</label>
                                <input type="search" list="ssnames" class="form-control" value="" name="station_code"
                                    id="ssname" onchange="getStation(),getAdmins()">
                                <datalist id="ssnames">
                                    @foreach ($stations as $station)
                                        <option value="{{ $station->SSNAME }}">
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
                        <div class="row m-3 bg-warning pb-2">
                            <div class="col-lg-6">
                                <label for="department" class="control-label m-3">Department</label>
                                <select name="department" id="department" class="form-control "
                                    onChange="checkDepartment() ,getAdmins()">
                                    <!--placeholder-->
                                    <option value="1">Mechanical</option>
                                    <option value="2">Chemistry</option>
                                    <option value="3">Electrical</option>
                                </select>
                            </div>
                            <div class=" col-lg-6 d-none" id="main_alarm">
                                <label for="main_alarm" class="control-label m-3">Main Alarm</label>
                                <select name="mainAlarm" class="form-control">
                                    <option value="Fan Trouble alarm">Fan Trouble alarm</option>
                                </select>
                            </div>


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
                        <!--Work type for electrical-->
                        <div class="row m-3 d-none" id="workType-ElectricalDiv">
                            <div class="col border border-warning p-3 flex-wrap">
                                <h6 class="text-warning">Work Type</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  checkbox" type="radio" name="work_type"
                                        id="inlineRadio1" value="Emergency" onClick="checkBoxElectrical('Duty')">
                                    <label class="form-check-label  m-2" for="inlineRadio1">Duty</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio2"
                                        value="Maintenance" onClick="checkBoxElectrical('program')">
                                    <label class="form-check-label m-2" for="inlineRadio2">program</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio3"
                                        value="Inspection" onClick="checkBoxElectrical('Servicing')">
                                    <label class="form-check-label m-2" for="inlineRadio3">Servicing</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input checkbox" type="radio" name="work_type" id="inlineRadio4"
                                        value="Inspection" onClick="checkBoxElectrical('Pending')">
                                    <label class="form-check-label m-2" for="inlineRadio4">Pending</label>
                                </div>

                            </div>
                        </div>
                        <div class="row m-3  d-none " id="alarm">
                            <label for="mechanical" id="section-label">Mechanical Alarm</label>
                            <select name="work_type_description" class="form-control d-none" id="MechAlarmSelect">

                            </select>
                            <select name="work_type_description" class="form-control d-none" id="chemistryAlarm">

                            </select>

                            <select name="work_type_description" class="form-control d-none" id="electricDuty">
                                <option value="Oil level alarm">Oil level alarm</option>
                                <option value="Oil temperature alarm">Oil temperature alarm</option>
                                <option value="Oil temperature trip">Oil temperature trip</option>
                                <option value="Winding temperature alarm<">Winding temperature alarm</option>
                                <option value="Winding temperature trip">Winding temperature trip</option>
                                <option value="Buchloz relay on main tank alarm">Buchloz relay on main tank alarm</option>
                                <option value="Buchloz relay on main tank trip">Buchloz relay on main tank trip</option>
                                <option value="Buchloz relay on tap chagner trip">Buchloz relay on tap chagner trip</option>
                                <option value="Out of step alarm">Out of step alarm</option>
                                <option value="Pressure relief trip">Pressure relief trip</option>
                                <option value="Tap changer trouble">Tap changer trouble</option>
                                <option value="AC supply failure">AC supply failure</option>
                                <option value="Fuse burnt">Fuse burnt</option>
                                <option value="Winding temperature for local transformer">Winding temperature for local
                                    transformer</option>
                            </select>
                            <select name="work_type_description" class="form-control d-none" id="electricProgram">
                                <option value="program with cmd for calbles leak">program with cmd for calbles leak</option>

                            </select>
                            <select name="work_type_description" class="form-control d-none" id="electricServicing">
                                <option value="Smart breather">Smart breather</option>
                                <option value="Oil leakage">Oil leakage</option>
                                <option value="Replace TR">Replace TR</option>
                                <option value="Spur TR testing">Spur TR testing</option>
                                <option value="Spur transformer flash LT">Spur transformer flash LT</option>
                                <option value="Spur transformer flash HT">Spur transformer flash HT</option>
                                <option value="Spur transformer replacing">Spur transformer replacing</option>
                                <option value="Fixing spur TR">Fixing spur TR</option>
                                <option value="oil filling">oil filling</option>
                                <option value="Summer check">Summer check</option>
                                <option value="Winter check">Winter check</option>
                                <option value="Winding temperature for local transformer">Winding temperature for local
                                    transformer</option>
                            </select>

                            <select name="work_type_description" class="form-control d-none" id="electricPending">
                                <option value="Change MCB">Change MCB</option>
                                <option value="Change parts">Change parts</option>
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
                                <select name="shift" id="shiftSelect" class="form-control SlectBox"
                                    onchange="getEngineersShift()">
                                    <!--placeholder-->
                                    <option value="0"> صباحاً </option>
                                    <option value="1"> مساءً </option>
                                </select>

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">اسم المهندس</label>
                                <select id="eng_name" name="eng_name" class="form-control engineerSelect"
                                    onchange="getEngineerEmail()">
                                </select>
                            </div>
                            <div class=" col email">
                                <label for="inputName" class="control-label"> Email</label>
                                <input type="text" class="form-control" name="eng_email" id="eng_name_email">
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
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />

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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">جاري إرسال الإيميل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center mt-2 text-warning">Loading...Please wait</h5>
                    <div class="loader">

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
    <script type="text/javascript" src="{{ URL::asset('js/transformers/app.js') }}"></script>
@endsection
