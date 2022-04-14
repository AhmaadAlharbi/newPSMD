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
تفاصيل فاتورة
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">قائمة المهام </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تفاصيل المهمة</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
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



@if (session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif



<!-- row opened -->
<div class="row row-sm">

    <div class="col-xl-12">
        <!-- div -->
        <div class="card mg-b-20" id="tabs-style2">
            <div class="card-body">
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab3" class="nav-link" data-toggle="tab"> التفاصيل </a></li>
                                        <li><a href="#tab4" class="nav-link" data-toggle="tab">المستجدات </a></li>
                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab3">
                                        <div class="table-responsive mg-t-40">
                                            @foreach($tasks as $task)
                                            <table
                                                class="table table-hover table-invoice table-striped table-border text-md-nowrap mb-0">

                                                <tr>
                                                    <th class="border-bottom-0">رقم المهمة</th>
                                                    <td colspan="4">{{$task->refNum}}</td>

                                                </tr>

                                                <tr>
                                                    <th class="border-bottom-0">اسم المحطة </th>
                                                    <td colspan="4">{{$task->station->SSNAME}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0">اسم المحطة </th>
                                                    <td colspan="4">{{$task->station->fullName}}</td>
                                                </tr>



                                                <tr>
                                                    <th class="border-bottom-0">Main Alarm</th>
                                                    <td colspan="4">{{$task->main_alarm}}</td>

                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0">Voltage Level </th>
                                                    <td colspan="4">{{$task->Voltage_level}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0">Work Type</th>
                                                    <td colspan="4">{{$task->work_type}}</td>

                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0">تاريخ ارسال المهمة</th>
                                                    <td>{{$task->task_date}}</td>



                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0">Equip./Unit Affected </th>
                                                    <td colspan="4">{{$task->equip}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0">Nature of Fault</th>
                                                    <td colspan="4">{{$task->problem}}</td>
                                                </tr>

                                                <tr>
                                                    <th>ملاحظات</th>
                                                    <td colspan="4">{{$task->add_more}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="border-bottom-0 wd-40p">المهندس</th>
                                                    @if(isset($task->users->name))
                                                    <td>{{$task->users->name}}</td>
                                                    @else
                                                    <td>waiting...</td>
                                                    @endif

                                                </tr>
                                                @endforeach

                                            </table>
                                        </div>
                                    </div>


                                    <div class="tab-pane " id="tab4">
                                        <div class="table-responsive mt-15">
                                            {{--TABLE OF TASKS--}}
                                            <table class="table center-aligned-table mb-0 table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th class="border-bottom-0">رقم المهمة</th>
                                                        <th class="border-bottom-0"> القسم </th>
                                                        <th class="border-bottom-0">اسم المحطة </th>
                                                        <th class="border-bottom-0"> تاريخ الارسال</th>
                                                        <th class="border-bottom-0">المهندس</th>
                                                        <th class="border-bottom-0">الحالة </th>
                                                        <th class="border-bottom-0">بواسطة </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 0;
                                                    @endphp

                                                    <tr class="table-secondary">
                                                        @foreach($tasks as $x)
                                                        @php
                                                        $i++
                                                        @endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$x->refNum}}</td>
                                                       @if(isset($x->sections->section_name))
                                                       <td>{{$x->sections->section_name}}</td>
                                                       @else
                                                       <td>{{$x->toSections->section_name}}</td>

                                                       @endif
                                                        <td>{{$x->station->SSNAME}}</td>
                                                        <td>{{$x->task_date}}</td>
                                                        @if(isset($x->eng_id))
                                                        <td>{{$x->users->name}}</td>
                                                        @else
                                                        <td>waiting...</td>
                                                        @endif

                                                        @if($x->status == 'completed')
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-success">{{$x->status}}</span>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-danger">{{$x->status}}</span>

                                                        </td>
                                                        @endif
                                                        <td>{{$x->user}}</td>

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="table-responsive mt-5">
                                            {{--TABLE OF TASKS DETAILS--}}
                                            <h4 class=" mb-3">مستجدات المهندس</h4>
                                            <table class="table center-aligned-table mb-0 table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th class="border-bottom-0"> التاريخ</th>
                                                        <th class="border-bottom-0"> القسم</th>
                                                        <th class="border-bottom-0"> المهندس</th>
                                                        <th class="border-bottom-0"> ملاحظات المهندس</th>
                                                        <th class="border-bottom-0">action take</th>
                                                        <th class="border-bottom-0">الحالة </th>
                                                        <th class="border-bottom-0"> سبب عدم الانجاز </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp

                                                    <tr class="table-light">
                                                        @foreach($task_details as $x)
                                                        @php
                                                        $i++
                                                        @endphp
                                                        <td>{{$i}}</td>
                                                        <td>{{$x->report_date}}</td>
                                                        <td>{{$x->sections->section_name}}</td>

                                                        @if(isset($x->users->name))
                                                        <td>{{$x->users->name}}</td>
                                                        @else
                                                        <td>waiting...</td>
                                                        @endif
                                                        <td>{{$x->engineer_notes}}</td>
                                                        <td>{{$x->action_take}}</td>
                                                        @if($x->status == 'completed')
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-success">{{$x->status}}</span>
                                                        </td>
                                                        @elseif($x->status == 'pending')
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-danger">{{$x->status}}</span>

                                                        </td>
                                                        @else
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-warning">{{$x->status}}</span>

                                                        </td>
                                                        @endif
                                                        <td>{{$x->reasonOfUncompleted}}</td>

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="tab6">
                                        <!--المرفقات-->
                                        <div class="card card-statistics">
                                            <div class="card-body">

                                            </div>
                                            <br>
                                            <div class="table-responsive mt-15">
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
                                                        @foreach ($task_attachment as $attachment)
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
                                                                <button class="btn btn-outline-danger btn-sm"
                                                                    data-toggle="modal"
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
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /div -->
    </div>

</div>
<!-- /row -->

<!-- delete -->
<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('delete_file')}}" method="post">

                @csrf
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>
                    <input type="hidden" name="file_name" id="file_name" value="">
                    <input type="hidden" name="id_file" id="id_file" value="">
                    <input type="hidden" name="invoice_number" id="invoice_number" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
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
$('#delete_file').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id_file = button.data('id_file')
    var file_name = button.data('file_name')
    var invoice_number = button.data('invoice_number')
    var modal = $(this)
    modal.find('.modal-body #id_file').val(id_file);
    modal.find('.modal-body #file_name').val(file_name);
    modal.find('.modal-body #invoice_number').val(invoice_number);
})
</script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

@endsection