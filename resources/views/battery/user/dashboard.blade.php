@extends('layouts.master')
@section('title')
لوحة التحكم
@stop

@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">لوحة تحكم إدارة مهمات قسم البطاريات</h2>
        </div>
        <button type="button" class="btn mt-4 btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
            search by Engineer
        </button>
        <button type="button" class="btn mt-4 btn-outline-info" data-toggle="modal" data-target="#exampleModal2">
            search by station
        </button>

        <!-- Modal engineer-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <label for="">Select an Engineer's name:-</label>
                            <input list="engineers" class="form-control" name="engineer" id="engineer"
                                onchange="getEngineerName()">
                            <input type="hidden" id="hiddenName">
                            <datalist id="engineers">
                                @foreach($engineers as $engineer)
                                <option value="{{$engineer->name}}">

                                    @endforeach
                            </datalist>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a id="name-link" class="btn btn-primary">search</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Station-->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <label for="">Select an S/S name:-</label>
                            <input list="stations" name="station" class="form-control" id="station"
                                onchange="getStationName()">
                            <input type="hidden" id="hiddenStation">
                            <datalist id="stations">
                                @foreach($stations as $station)
                                <option value="{{$station->SSNAME}}">

                                    @endforeach
                            </datalist>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a id="station-link" class="btn btn-primary">search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
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
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-info-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white"
                            href="{{route('battery.engineerPageTask',['id'=>Auth::user()->email])}}">
                            مهماتي
                        </a>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">

                                {{\App\Models\Task::where('eng_id',App\Models\Engineer::where('email',Auth::user()->email)->value('id'))->count()}}
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمة</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 text-white"><a class="text-white"
                            href="{{route('battery.engineerPageTaskUncompleted',['id'=>Auth::user()->email])}}">مهماتي
                            الغير
                            منجزة</a></h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                @if(\App\Models\Task::count()!==0)
                                {{\App\Models\Task::where('eng_id',App\Models\Engineer::where('email',Auth::user()->email)->value('id'))->where('status','pending')->count()}}
                                @endif
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمة غير منجزة</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white"
                            href="{{route('battery.engineerPageTaskCompleted',['id'=>Auth::user()->email])}}"> تقاريري
                        </a> </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('eng_id',App\Models\Engineer::where('email',Auth::user()->email)->value('id'))->where('status','completed')->count()}}
                            </h4>
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمة منجزة</p>

                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 text-white">
                        <a class="text-white" href="{{route('battery.user.archive')}}">ارشيف التقارير</a>
                    </h6>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','completed')->where('fromSection',3)->count()}}
                            </h4>
                            <p class="mb-0 tx-12 text-white op-7">
                                تقرير
                            </p>
                        </div>
                        <!-- <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white op-7"> -152.3</span>
                        </span> -->
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>


    <div class="container">
        <div class="row row-sm">
            <div class="col-xl-4 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header pb-1">
                        <h3 class="card-title mb-2"> آخر المهمات</h3>
                        <p class="tx-12 mb-0 text-muted"></p>
                    </div>
                    @foreach($tasks as $task)
                    <div class="card-body p-0 customers mt-1">
                        <div class="list-group list-lg-group list-group-flush">
                            <div class="list-group-item list-group-item-action" href="#">
                                <div class="media mt-0">
                                    <img class="avatar-lg rounded-circle ml-3 my-auto"
                                        src="{{URL::asset('image/electricIcon.svg')}}" alt="Image description">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <div class="mt-0">
                                                <p class="text-right text-muted"> {{$task->created_at}}</p>
                                                <span class="badge badge-danger ml-2">
                                                    {{$task->status}}</span>
                                                <h5 class="m-1 tx-15">{{$task->engineers->name}}</h5>
                                                <p class="mb-0 tx-13 text-muted">ssname: {{$task->station->SSNAME}} </p>
                                                <a href="{{route('battery.user.taskDetails',['id'=>$task->id])}}"
                                                    class=" my-2 btn btn-outline-secondary ">Read More</a>
                                                <a class="text-left btn btn-dark "
                                                    href="{{route('battery.engineerReportForm',['id'=>$task->id])}}"
                                                    class=" m-2 btn btn-primary btn-sm">Action Take</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-8 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header pb-1">
                        <h3 class="card-title mb-2"> تقارير شهر </h3>

                    </div>
                    <?php $count = 0; ?>
                    @foreach($task_details as $task_detail)
                    <div class="product-timeline card-body pt-2 mt-1 text-center">
                        <ul class="timeline-1 mb-0">
                            <li class="mt-0 mb-0"> <i
                                    class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                                <!-- <p class=" badge badge-success ">{{$task_detail->status}}</p> -->
                                <p class="text-right text-muted"> {{$task_detail->created_at}}</p>
                                <p class="  p-3 mb-2 bg-dark text-white text-cente">Engineer :
                                    {{$task_detail->engineers->name}}
                                </p>
                                <p class="  bg-white text-dark text-center  "><ins>Station :
                                        {{$task_detail->tasks->station->SSNAME}}</ins>
                                </p>
                                <p class=" bg-white text-secondary font-weight-bold text-center">Nature of fault :
                                    {{$task_detail->problem}}</p>
                                @if(is_null($task_detail->action_take))
                                <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                                    {{$task_detail->reasonOfUncompleted}}
                                </p>
                                @else
                                <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                                    {{$task_detail->action_take}}
                                </p>
                                @endif
                                <a class="btn btn-info mt-2 text-center"
                                    href="{{route('battery.user.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                                <a class="btn btn-outline-dark mt-2 text-center"
                                    href="{{route('battery.user.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                                @if(Auth::user()->email == $task_detail->engineers->email )
                                {{--  <button type="button" class="btn btn-secondary mt-2 text-center" data-toggle="modal"
                                    data-target="#myModal<?php echo $count; ?>">
                                     Edit
                                </button>--}}
                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $count; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">تحديث التقرير</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">

                                                    <textarea name="action_take" id="" class="form-control"
                                                        rows="10">{{$task_detail->action_take}}</textarea>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                @endif
                            </li>
                        </ul>


                    </div>
                    <hr class="my-4   bg-secondary  ">
                    <?php $count++; ?>
                    @endforeach
                    <nav aria-label="Page navigation pagination-sm   pagination-lg justify-content-center ">
                        <ul class="pagination">
                            <li class="page-item">
                                {{$task_details->links()}}

                            </li>

                        </ul>
                    </nav>
                </div>
            </div>


        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('js/scripts.js')}}"></script>


    @endsection

    @section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('assets/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
    @endsection