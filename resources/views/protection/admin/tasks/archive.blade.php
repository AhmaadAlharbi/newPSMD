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
<style>
    /* input[type='date'] {
        position: relative;


    }

    input[type='date']:before {
        position: absolute;
        top: 3px;
        left: 3px;
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input[type='date']::-webkit-datetime-edit,
    input[type='date']::-webkit-inner-spin-button,
    input[type='date']::-webkit-clear-button {
        display: none;
    }

    input[type='date']::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 3px;
        right: 0;
        color: black;
        opacity: 1;
    } */
</style>

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


<!--div-->
<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="col-lg-6 mt-4">
            <form action="{{route('protection.staionsByDates')}}">
                @csrf
                <div class="row">
                    <div class="col-12 my-2">
                        <label for="">المحطة</label>
                        <input list="ssnames" class="form-control" value="" name="station_code" id="ssname"
                            onchange="getStation()" type="search">
                        <datalist id="ssnames">
                            @foreach ($stations as $station)
                            <option value="{{ $station->SSNAME }}">
                                @endforeach
                        </datalist>
                        <input type="hidden" id="station_id" name="ssnameID">
                        <script>
                            function getStation(){
                            const stationID = document.getElementById('station_id');
                            const ssname = document.getElementById('ssname');

                            stationID.value = ssname.value;
                         }
                        </script>
                    </div>
                    <div class="col-12 my-2">
                        <label for="">المهندس</label>
                        <input list="engineers" class="form-control" value="" name="engineer" id="engineer"
                            onchange="getEngineer()" type="search">
                        <datalist id="engineers">
                            @foreach ($engineers as $engineer)
                            <option value="{{ $engineer->name }}">
                                @endforeach
                        </datalist>
                        <input type="hidden" id="engineer_name" name="engineer_name">
                        <script>
                            function getEngineer(){
                            const engineer = document.getElementById('engineer');
                            const engineer_name = document.getElementById('engineer_name');
                            engineer_name.value = engineer.value;
                         }
                        </script>
                    </div>

                    <div class="col">
                        من
                        <input type="date" data-date="" class="form-control" name="task_Date" value="">
                    </div>
                    <div class="col">
                        الى
                        <input type="date" data-date="" class="form-control" name="task_Date2" value="">
                    </div>
                </div>

                <input type="submit" class="btn btn-outline-danger btn-md btn-block" value="البحث في فترة معينة ">
            </form>
            {{--

            <input type="text" data-date="" class="form-control" name="task_Date" data-date-format="DD/MM/YYYY"
                value="{{ date('Y-m-d') }}">
            <input type="text" data-date="" class="form-control" name="task_Date2" data-date-format="DD/MM/YYYY"
                value="{{ date('Y-m-d') }}"> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                adad
                <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">رقم المهمة</th>
                            <th class="border-bottom-0">اسم المحطة </th>
                            <th class="border-bottom-0"> Equip Number </th>
                            <th class="border-bottom-0"> Equip Name </th>
                            <th class="border-bottom-0">تاريخ ارسال المهمة</th>
                            <th class="border-bottom-0">المهندس</th>
                            <th class="border-bottom-0">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($tasks as $task)
                        @php
                        $i++;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href="{{ route('protection.admin.taskDetails', ['id' => $task->task_id]) }}">{{
                                    $task->tasks->refNum }}</a>
                            </td>
                            <td>{{ $task->tasks->station->SSNAME }}</td>



                            <td>{{ $task->tasks->equip_number }}</td>
                            <td>{{ $task->tasks->equip_name }}</td>
                            <td>{{ $task->task_date }}</td>
                            @if (isset($task->users->name))
                            <td>{{ $task->users->name }}</td>
                            @else
                            <td>waiting...</td>
                            @endif


                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                        type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item"
                                            href="{{ route('protection.changeSectionView', ['id' => $task->task_id]) }}"><i
                                                class="text-warning fas fa-fast-forward"></i>&nbsp;&nbsp;
                                            تحويل لقسم آخر
                                        </a>
                                        @if ($task->status === 'completed')
                                        <a class="dropdown-item"
                                            href="{{ route('protection.veiwReport', ['id' => $task->task_id]) }}"><i
                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                            التقرير
                                        </a>

                                        {{-- <a class=" dropdown-item btn btn-outline-info "
                                            href="{{url('generate-pdf')}}/{{$task->id}}">
                                            <i class="text-info fas fa-download"></i>&nbsp;&nbsp; تحميل
                                        </a> --}}
                                        @else
                                        <a class="dropdown-item"
                                            href="{{ route('protection.updateTask', ['id' => $task->task_id]) }}">
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
                <form action="{{ route('protection.destroyTask') }}" method="post">
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
<script>
    // var date = $('.fc-datepicker').datepicker({
    //     dateFormat: 'dd-mm-yy'
    // }).val();

    // $("input").on("change", function() {
    //     this.setAttribute(
    //         "data-date",
    //         moment(this.value, "YYYY-MM-DD")
    //         .format( this.getAttribute("data-date-format") )
    //     )
    // }).trigger("change")
</script>
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>

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