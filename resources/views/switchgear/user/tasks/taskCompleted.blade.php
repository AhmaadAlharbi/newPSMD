@extends('layouts.master')
@section('title')
المهمات
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كل
                المهمات

            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('delete_invoice'))
<script>
window.onload = function() {
    notif({
        msg: "تم حذف المهمة بنجاح",
        type: "success"
    })
}
</script>
@endif


@if (session()->has('Status_Update'))
<script>
window.onload = function() {
    notif({
        msg: "تم تحديث حالة الدفع بنجاح",
        type: "success"
    })
}
</script>
@endif

<!-- row -->
<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">رقم المهمة</th>
                                <th class="border-bottom-0">اسم المحطة </th>
                                <th class="border-bottom-0"> التحكم </th>

                                <th class="border-bottom-0">تاريخ ارسال المهمة</th>
                                <th class="border-bottom-0">المرفقات </th>
                                <th class="border-bottom-0">Action Take </th>
                                <th class="border-bottom-0">تعديل</th>


                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($tasks as $task)
                            @php
                            $i++
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                   <a href="{{route('switch.user.veiwReport',['id'=>$task->task_id])}}">{{$task->tasks->refNum}}</a>

                                </td>
                                <td>{{$task->tasks->station->SSNAME}}</td>
                                @if($task->tasks->station->control == 'JAHRA CONTROL CENTER')
                                <td class="table-warning">{{$task->tasks->station->control}}
                                </td>
                                @elseif($task->tasks->station->control == 'JABRIYA CONTROL CENTER')
                                <td class="table-info">{{$task->tasks->station->control}}
                                </td>
                                @elseif($task->tasks->station->control == 'TOWN CONTROL CENTER')
                                <td class="table-danger">{{$task->tasks->station->control}}
                                </td>
                                @elseif($task->tasks->station->control == 'SHUAIBA CONTROL CENTER')
                                <td class="table-success">{{$task->tasks->station->control}}
                                </td>
                                @else
                                <td class="table-light">{{$task->tasks->station->control}}</td>
                                @endif
                                <td>{{$task->tasks->task_date}}</td>
                                <td><a href="{{route('switch.user.taskDetails',['id'=>$task->tasks->id])}}"
                                        class=" btn btn-info">Details</a></td>
                                <td>
                                    @if($task->status == 'pending')
                                    <a href="{{route('switch.engineerReportForm',['id'=>$task->tasks->id])}}"
                                        class="btn btn-danger">Action
                                        Take</a>
                                </td>
                                @endif
                                @if($task->status == 'completed')
                                <a href="{{route('switch.user.veiwReport',['id'=>$task->task_id])}}"
                                    class="btn btn-success">Report</a>
                                </td>
                                @switch($task->report_status)
                                @case(1)
                                <td> <a href="{{route('switch.requestEditReport',['id'=>$task->task_id])}}"
                                        class="btn btn-outline-secondary">طلب تعديل</a>
                                </td>
                                @break
                                @case(2)
                                <td> <button class="btn btn-secondary " disabled> waiting ...
                                    </button>
                                    <span class="d-block text-danger">يرجى انتظار موافقة رئيس القسم</span>

                                </td>
                                @break
                                @case(0)
                                <td> <a href="{{route('switch.editReport',['id'=>$task->task_id])}}"
                                        class="btn btn-info"> تعديل</a>
                                </td>
                                @break
                                @default
                                <td> <a href="{{route('switch.requestEditReport',['id'=>$task->id])}}"
                                        class="btn btn-danger"> erorr</a>
                                    @endswitch
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>

<!-- حذف المهمة -->
<div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                هل انت متاكد من عملية الحذف ؟
                <input type="hidden" name="invoice_id" id="invoice_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
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
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
$('#delete_invoice').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var invoice_id = button.data('invoice_id')
    var modal = $(this)
    modal.find('.modal-body #invoice_id').val(invoice_id);
})
</script>

<script>
$('#Transfer_invoice').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var invoice_id = button.data('invoice_id')
    var modal = $(this)
    modal.find('.modal-body #invoice_id').val(invoice_id);
})
</script>


@endsection