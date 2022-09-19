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
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
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

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */

    }

    @keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{route('protection.gc.showAllTasks')}}">عرض
                            كافة
                            مهمات شهر {{$monthName}}</a>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\gc_tasks::whereMonth('created_at',
                                date('m'))->where('section_id',2)->count()}}
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
                            href="{{route('protection.admin.pendingTasks')}}">المهمات الغير
                            منجزة</a></h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\gc_tasks::where('status','pending')->where('section_id',2)->count()}}
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات غير منجزة</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
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
                    <h6 class="mb-3 tx-16 "><a class="text-white"
                            href="{{route('protection.admin.completedTasks')}}">المهمات
                            المنجزة</a> </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\gc_tasks::whereMonth('created_at',
                                date('m'))->where('section_id',2)->where('status','completed')->count()}}
                            </h4>
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات منجزة</p>

                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
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
                        <a class="text-white" href="{{route('protection.admin.archive')}}">ارشيف التقارير</a>
                    </h6>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\gc_tasks::where('section_id',2)->where('status','completed')->count()}}
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
<div class="row row-sm">
    <div class="col-xl-4 col-md-12 col-lg-6">
        <h5 class="py-3 bg-white mt-2 text-center">المهمات المنشئة</h6>
            @foreach($tasks as $task)
            <div class="card-body p-0 customers mt-1">
                <div class="list-group list-lg-group list-group-flush">
                    <div class="list-group-item list-group-item-action" href="#">
                        <div class="media  mt-0">
                            <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{ asset('image/alert.png') }}"
                                alt="Image description">
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <div class="mt-0">

                                        <p class="text-right text-muted"> {{ $task->created_at }}</p>
                                        <span class="badge badge-danger text-white ml-2">

                                            {{ $task->status }}
                                        </span>
                                        <p class="mb-0 tx-13 text-dark">ssname: {{ $task->station_name }}</p>
                                        <h5 class="m-1 tx-15">{{ $task->users->name }}</h5>

                                        <a href="{{ route('protection.admin.taskDetails', ['id' => $task->id]) }}"
                                            class=" my-2 btn btn-outline-secondary ">Read More</a>


                                        <a class="text-left btn btn-success "
                                            href="{{ route('protection.updateTask', ['id' => $task->id]) }}"
                                            class=" m-2 btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
    </div>
    <div class="mt-5 col-xl-8 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header pb-1">
                <h5 class="border-bottom py-3 text-center"> تقارير شهر {{$monthName}}</h5>
                @foreach($reports as $report)
                <div class="product-timeline card-body pt-2 mt-1 text-center ">
                    <ul class="timeline-1 mb-0 ">
                        <li class="mt-0 mb-0 "> <i
                                class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                            <p class="text-right text-muted"> {{$report->created_at}}</p>
                            <p class="p-3 mb-2 bg-dark text-white text-center">Engineer :
                                {{$report->users->name}}
                            </p>
                            <p class="  bg-white text-dark text-center  "><ins>Station :
                                    {{$report->task->station_name}}

                                </ins></p>
                            <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                                {{$report->action_take}}
                            </p>
                            <a class="btn btn-info mt-2 text-center"
                                href="{{route('protection.gc.veiwReport',['id'=>$report->task_id])}}">Report</a>
                            {{-- <a class="btn btn-outline-dark mt-2 text-center"
                                href="{{route('switch.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                            --}}

                    </ul>
                </div>
                @endforeach
            </div>

        </div>

    </div>
</div>

<!-- row close -->

<!-- Container closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>

@endsection