@extends('layouts.master')
@section('css')
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
    .mew-logo {
        width: 250px;
    }

    .kuwait {
        visibility: hidden;
    }


    #table1,
    #table2 {
        direction: ltr;
    }

    .ssname-table {
        direction: ltr;

    }

    #table0 th,
    #table1 th,
    #table2 th {
        font-size: 20px;
    }

    .print-title {
        background: #e6e6e8 !important;
    }

    td {
        font-size: 20px;
    }

    #table0 td,
    #table1 td,
    #table2 td,
        {

        font-size: 19px;
    }


    /* #table th,
                                                                                                                                                                                    #table td {
                                                                                                                                                                                        transform: rotate(-90deg);
                                                                                                                                                                                    } */

    td {
        height: 50px;
    }
</style>
<style>
    @media print {
        #print_Button {
            display: none;
        }

        body {
            -webkit-print-color-adjust: exact !important;
        }


        #table1 th,
        #table2 th .print-title {
            background: #e6e6e8 !important;
        }

        #table1 td,
        #table2 td {
            font-size: 19px;
        }



    }
</style>
@endsection
@section('page-header')
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                report</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div class="test row row-sm " id="print">
    <div class="col-md-12 col-xl-12 ">
        <div class=" main-content-body-invoice border border-dark">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">

                        <div class="billed-from">

                        </div><!-- billed-from -->

                        <div class="billed-from">
                            <img class="mew-logo rounded " src="https://www.mew.gov.kw/images/logo@2x.png"
                                alt="mew logo">
                        </div><!-- billed-from -->

                    </div><!-- invoice-header -->


                    <div class="container">
                        <div class="d-block p-3  print-title text-dark">
                            <p class="text-center">Primary substation maintenance department</p>

                            <h2 class="text-center "> General Check Report</h2>
                            <h5 class="text-center m-1"><ins>Ref.No: </ins></h5>

                        </div>

                        {{-- --}}
                        {{-- <div class="mt-3">
                            <h3 class=" text-center  py-4 px-3 bg-secondary text-light">
                                {{ $tasks->station->fullName }}<br>{{ $tasks->station->control }} -
                                {{ $tasks->voltage_level }}</h3>

                        </div> --}}
                        <div class="text-left">
                            <div class=" row ssname-table  ">
                                <div class=" d-print-none col-sm-12 col-print-12  col-lg-4">
                                    <h1
                                        class="d-none
                                    d-sm-flex justify-content-center align-items-center text-center rounded-lg mt-2 display-1 py-5 h-100 bg-white text-dark border border-dark">
                                        {{ $task->station_name }}
                                    </h1>
                                    <h1 style="font-size:44px;"
                                        class="d-block 
                             justify-content-center align-items-center text-center mt-2  p-5 h-100 bg-dark text-white d-sm-none">
                                        {{ $task->station_name }}

                                    </h1>
                                </div>

                                <div
                                    class="d-none d-sm-block d-print-none col-sm-12  col-lg-8  col-print-12  table-responsive-sm">
                                    <table class=" table mt-2 p-5 border border-dark h-100 text-center" id="table1"
                                        class="ltr-table ">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Company Make</th>
                                                <th scope="col">Contract.No</th>

                                            </tr>
                                            <tr></tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>{{ $task->make}}</td>
                                                <td>{{ $task->contract_number}}</td>

                                            </tr>
                                        </tbody>
                                        <tr>
                                            <thead class="thead-light">
                                                <th scope="col">COMMISIONING DATE</th>
                                                <th scope="col">contractor</th>
                                            </thead>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>-</td>
                                                <td>{{$task->contractor}}</td>

                                            </tr>
                                        </tbody>

                                    </table>

                                </div>
                                {{-- mobile screen table --}}
                                <div class="d-block d-sm-none col-sm-12">
                                    <table class=" table mt-2 p-5 border border-dark h-100 text-center" id="table1"
                                        class="ltr-table ">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Company Make</th>

                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $task->make}}</td>


                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <th scope="col">Contract.No</th>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $task->contract_number}}</td>

                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <th scope="col">COMMISIONING DATE</th>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>-</td>

                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <th scope="col">contractor
                                            </th>

                                        <tbody>
                                            <tr>
                                                <th scope="col">contractor</th>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="d-block p-3 mb-2 mt-3 bg-white text-dark">
                                <h2>Control</h2>
                                <h3>{{$task->control}}</h3>

                            </div>


                            <button type="button" class="btn  btn-lg btn-dark" data-toggle="modal"
                                data-target="#exampleModal">
                                Can not complete the task
                            </button>
                            <form action="{{ route('protection.generalCheck.submitReport', ['id' => $task->id]) }}"
                                enctype="multipart/form-data" method="post" autocomplete="off">
                                @csrf
                                <div class="my-2  text-dark">
                                    <h2>Action Take</h2>
                                    <textarea name="action_take" placeholder="Write Your Report here"
                                        style="text-align: left; font-size:20px;" rows="5" cols="100"
                                        class="form-control"></textarea>
                                </div>
                                <div id="attachmentFile" class="e">
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
                                {{-- attachments table --}}
                                <div class="tabcontent table-responsive my-5 " id="attachments">
                                    <h6 class="text-right">المرفقات</h6>
                                    <table class="table center-aligned-table mb-0  table-hover"
                                        style="text-align:center">
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
                                                        href="{{ route('protection.view_file', ['id' => $attachment->id_task, 'file_name' => $attachment->file_name]) }}"
                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                        عرض</a>

                                                    <a class="btn btn-outline-info btn-sm"
                                                        href="{{ route('protection.download_file', ['id' => $attachment->id_task, 'file_name' => $attachment->file_name]) }}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;
                                                        تحميل</a>
                                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                        data-file_name="{{ $attachment->file_name }}"
                                                        data-invoice_number="{{ $attachment->id_task }}"
                                                        data-id_file="{{ $attachment->id }}"
                                                        data-target="#delete_file">حذف</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                                <button class="btn btn-lg btn-success-gradient btn-block">Submit</button>
                            </form>


                            <div class="d-block p-3 mb-2 bg-white text-dark">
                                <h2>Engineer</h2>
                            </div>
                            <h4 class="  ml-4 "><br>

                            </h4>
                            <p class="ml-4 lead"></p>
                        </div>

                    </div>
                    <hr class=" mg-b-40">



                </div>

            </div>
        </div>
    </div><!-- COL-END -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> سبب عدم الإنجاز </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="" method="post">
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> اختر السبب</label>
                        <select name="reason" class="form-control" id="exampleFormControlSelect1">
                            <option value="مسؤولية جهة آخرى">مسؤولية جهة آخرى</option>
                            <option value="تحت الكفالة">تحت الكفالة</option>
                            <option value="قطع غيار غير متوفرة "> قطع غيار غير متوفرة </option>
                            <option value="بإنتظار إصلاحات"> بإنتظار إصلاحات</option>
                            <option value="تحويل المهمة لمهندس آخر">تحويل المهمة لمهندس آخر </option>
                            <option value="آخرى"> آخرى</option>
                        </select>
                        <!--Take all these hidden value to the form-->
                        {{-- <input type="hidden" class="form-control" id="inputName" name="refNum"
                            value="{{ $tasks->refNum }}" readonly>
                        <input type="hidden" class="form-control" readonly name="ssname" id="ssname"
                            value="{{ $tasks->station->id }}">
                        <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                            type="hidden" value="{{ $tasks->task_Date }}" readonly required>
                        <input type="hidden" class="form-control" readonly name="equip" id="equip"
                            value="{{ $tasks->equip }}">
                        <input type="hidden" class="form-control" readonly value="{{ $tasks->problem }}" name="problem"
                            id="problem">
                        <input class="form-control fc-datepicker" name="report_Date" placeholder="YYYY-MM-DD"
                            type="hidden" value="{{ date('Y-m-d') }}" readonly required>
                        <input type="hidden" class="form-control" name="eng_name" readonly
                            value="{{ $tasks->users->name }}">
                        <textarea type="hidden" style="display:none;" class="form-control" id="exampleTextarea"
                            name="notes" readonly rows="3">{{ $tasks->notes }}</textarea> --}}
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
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script type="text/javascript">
    function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
</script>
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
<script type="text/javascript" src="{{ URL::asset('js/protection/app.js') }}"></script>
@endsection