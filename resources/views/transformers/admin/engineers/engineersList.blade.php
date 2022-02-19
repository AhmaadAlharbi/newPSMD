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
            <h4 class="content-title mb-0 my-auto">المهندسين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">


            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('delete'))
<script>
window.onload = function() {
    notif({
        msg: "تم حذف المهمة بنجاح",
        type: "success"
    })
}
</script>
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
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" class="btn btn-success m-3" data-toggle="modal" data-target="#exampleModal">
                        اضافة مهندس
                    </button>
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">الاسم</th>
                                <th class="border-bottom-0"> البريد الإلكتروني </th>
                                <th class="border-bottom-0"> هاتف </th>
                                <th class="border-bottom-0"> القسم </th>
                                <th class="border-bottom-0"> المنطقة </th>
                                {{--<th class="border-bottom-0"> shift </th>--}}
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($engineers as $engineer)
                            @php
                            $i++
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$engineer->user->name}}</td>
                                <td>{{$engineer->user->email}}</td>
                                <td>{{$engineer->user->mobile}}</td>
                                @if($engineer->department ==1)
                                <td>Mechanical</td>
                                @elseif($engineer->department ==2)
                                <td>Chemistry</td>
                                @else
                                <td>Electrical</td>
                                @endif
                                @if($engineer->area == 1)
                                <td>الشمالية</td>
                                @elseif($engineer->area ==2)
                                <td>الجنوبية</td>
                                @else
                                <td>الوسطى</td>
                                @endif
                                {{-- @if($engineer->shift == 0)
                                <td>Morning</td>
                                @else
                                <td>Evening</td>
                                @endif--}}
                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            <a class="dropdown-item" href="">تعديل</a>
                                            <form action="" method="POST"> @csrf
                                                @method('delete');
                                                <button class="dropdown-item" href="">حذف</button>
                                            </form>

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

<!-- اضافة  المحطة -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة مهندس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('battery.addEngineer')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="eng_name" class="control-label ">اسم المهندس</label>
                    <input type="text" name="eng_name" class="form-control m-2">
                    <label for="email" class="control-label ">البريد الإلكتروني</label>
                    <input type="text" name="email" class="form-control m-2">
                    <label for="mobile" class="control-label ">الهاتف </label>
                    <input type="text" name="mobile" class="form-control m-2">
                    <label for="area_id" class="control-label ">المنطقة</label>
                    <select name="area_id" id="area" class="form-control">
                        <!--placeholder-->
                        <option value="1">المنطقة الشمالية</option>
                        <option value="2">المنطقة الجنوبية</option>
                    </select>

                    <label for="shift_id" class="control-label ">shift</label>
                    <select name="shift_id" id="shift" class="form-control">
                        <!--placeholder-->
                        <option value="1">صباحاً</option>
                        <option value="2">مساءً</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- حذف  المحطة -->
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
});
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