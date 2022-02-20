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
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">لوحة تحكم إدارة مهمات قسم الوقاية</h2>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<style>
.HORIZONTAL_SCROLL_NAV {

    -webkit-overflow-scrolling: touch;

    overflow-x: auto;
    overflow-y: hidden;
}

.HORIZONTAL_SCROLL_NAV>ul {

    margin: 0 auto;
}
</style>

<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{ url('/' . $page='All_tasks') }}">عرض كافة
                            مهمات شهر {{$monthName}}</a>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::whereMonth('created_at', date('m'))->count()}}


                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات</p>
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
                            href="{{ url('/' . $page='task_uncompleted') }}">المهمات الغير
                            منجزة</a></h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','pending')->count()}}
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات غير منجزة</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white tx-16 op-7">
                                @if(\App\Models\Task::count()!==0)
                                {{round((\App\Models\Task::where('status','pending')->count()/\App\Models\Task::count())*100)}}%

                                @endif

                            </span>
                        </span>
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
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{ url('/' . $page='task_completed') }}">المهمات
                            المنجزة</a> </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','completed')->whereMonth('created_at', date('m'))->count()}}
                            </h4>
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات منجزة</p>

                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white tx-18 op-7">
                                @if(\App\Models\Task::count()!==0)
                                {{round((\App\Models\Task::where('status','completed')->count()/\App\Models\Task::count())*100)}}%
                                @endif
                            </span>
                        </span>
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
                        <a class="text-white" href="{{route('archive')}}">ارشيف التقارير</a>
                    </h6>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','completed')->count()}}
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

</div>
<!-- row closed -->


<!-- row closed -->

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-4 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header pb-1">
                <h3 class="card-title mb-2">آخر المهمات</h3>
                <p class="tx-12 mb-0 text-muted"></p>
            </div>
            @foreach($tasks as $task)
            <div class="card-body p-0 customers mt-1">
                <div class="list-group list-lg-group list-group-flush">
                    <div class="list-group-item list-group-item-action" href="#">
                        <div class="media  mt-0">

                            <img class="avatar-lg rounded-circle ml-3 my-auto" src="image/electricIcon.svg"
                                alt="Image description">

                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <div class="mt-0">
                                        <p class="text-right text-muted"> {{$task->created_at}}</p>

                                        @if($task->status == 'waiting')
                                        <span class="badge badge-warning text-white ml-2">

                                            {{$task->status}}
                                        </span>
                                        @else
                                        <span class="badge badge-danger ml-2">

                                            {{$task->status}}
                                        </span>
                                        @endif
                                        @if(isset($task->engineers->name))
                                        <h5 class="m-1 tx-15">{{$task->engineers->name}}</h5>
                                        @else
                                        <h5 class="m-1 tx-15 text-info border  p-2">Waiting to be assigned
                                        </h5>
                                        <a href="{{route('selectEngineer',['id'=>$task->id])}}"
                                            class="btn  btn-warning d-block">Assign Engineer</a>
                                        @endif

                                        <p class="mb-0 tx-13 text-dark">ssname: {{$task->station->SSNAME}} </p>
                                        <a href="/taskDetails/{{$task->id}}"
                                            class=" my-2 btn btn-outline-secondary ">Read More</a>
                                        @if(isset($task->engineers->name))

                                        <a class="text-left btn btn-dark "
                                            href="{{route('task.reminder',['id'=>$task->id,'eng_email'=>$task->engineers->email,'ssname'=>$task->station->SSNAME])}}"
                                            class=" m-2 btn btn-primary btn-sm">Resend Task</a>
                                        @endif
                                        {{--  <a class="text-left btn btn-danger "
                                            href="{{route('tasks.addYourReport',['id'=>$task->id])}}"
                                        class=" m-2 btn btn-primary btn-sm">Action Take</a>--}}
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
                <h1 class="card-title mb-2"> تقارير شهر {{$monthName}}</h1>

            </div>
            @foreach($task_details as $task_detail)
            <div class="product-timeline card-body pt-2 mt-1 text-center ">
                <ul class="timeline-1 mb-0 ">
                    <li class="mt-0 mb-0 "> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                        <!-- <p class=" badge badge-success ">{{$task_detail->status}}</p> -->
                        <p class="text-right text-muted"> {{$task_detail->created_at}}</p>
                        @if(isset($task_detail->engineers->name))
                        <p class="p-3 mb-2 bg-dark text-white text-center">Engineer :
                            {{$task_detail->engineers->name}}
                        </p> @else
                        <h5 class="m-1 tx-15">Waiting...</h5>
                        @endif

                        <p class="  bg-white text-dark text-center  "><ins>Station :
                                {{$task_detail->station->SSNAME}}</ins></p>
                        <p class=" bg-white text-secondary font-weight-bold text-center">Nature of fault :
                            {{$task_detail->problem}}</p>
                        <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                            {{$task_detail->action_take}}
                        </p>
                        <a class="btn btn-info mt-2 text-center" href="/Print_task/{{$task_detail->id_task}}">Report</a>
                        <a class="btn btn-outline-dark mt-2 text-center"
                            href="{{route('ShowTask',['id'=>$task_detail->id_task])}}">Details</a>
                    </li>
                </ul>

            </div>
            <hr class="my-4 bg-info">
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
<!-- row close -->

<!-- Container closed -->
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