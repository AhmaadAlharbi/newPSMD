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
</div>
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
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
                                <th class="border-bottom-0">المهندس</th>
                                <th class="border-bottom-0">بواسطة</th>
                                <th class="border-bottom-0">العمليات</th>
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
                                <td><a
                                        href="{{route('protection.admin.taskDetails',['id'=>$task->id])}}">{{$task->tasks->refNum}}</a>
                                </td>
                                <td>{{$task->tasks->station->SSNAME}}</td>


                                @if($task->tasks->station->control == "JAHRA CONTROL CENTER")
                                <td class="table-warning">{{$task->tasks->station->control}}
                                </td>
                                @elseif($task->tasks->station->control == "JABRIYA CONTROL CENTER")
                                <td class="table-info">{{$task->tasks->station->control}}
                                </td>
                                @elseif($task->tasks->station->control == "TOWN CONTROL CENTER")
                                <td class="table-danger">{{$task->tasks->station->control}}
                                </td>
                                @elseif($task->tasks->station->control == "SHUAIBA CONTROL CENTER")
                                <td class="table-success">{{$task->tasks->station->control}}
                                </td>
                                @else
                                <td class="table-light">{{$task->ttasks->station->control}}

                                    @endif

                                <td>{{$task->tasks->task_date}}</td>
                                @if(isset($task->tasks->users->name))
                                <td>{{$task->tasks->users->name}}</td>
                                @else
                                <td>waiting...</td>
                                @endif
                                
                                <td>{{$task->tasks->user}}</td>

                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item"
                                                href="{{route('protection.changeSectionView',['id'=>$task->task_id])}}"><i
                                                    class="text-warning fas fa-fast-forward"></i>&nbsp;&nbsp;
                                                تحويل لقسم آخر
                                            </a>
                                            @if($task->status ==="completed")
                                     
                                            <a class="dropdown-item"
                                                href="{{route('protection.veiwReport',['id'=>$task->task_id])}}"><i
                                                    class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                 التقرير
                                            </a>

                                            {{--  <a class=" dropdown-item btn btn-outline-info "
                                                href="{{url('generate-pdf')}}/{{$task->id}}">
                                            <i class="text-info fas fa-download"></i>&nbsp;&nbsp; تحميل
                                            </a>--}}
                                            @else

                                            <a class="dropdown-item"
                                                href="{{route('protection.updateTask',['id'=>$task->task_id])}}">
                                                تعديل
                                            </a>

                                            @endif
                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $task->task_id }}"
                                                data-toggle="modal" data-target="#delete_invoice"><i
                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                المهمة
                                            </a>
                                        </div>
                                    </div>
                                </td>


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
                <form action="{{route('protection.destroyTask')}}" method="post">
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