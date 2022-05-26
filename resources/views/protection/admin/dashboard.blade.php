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
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{route('protection.admin.showAllTasks')}}">عرض
                            كافة
                            مهمات شهر {{$monthName}}</a>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::whereMonth('created_at', date('m'))->where('fromSection',2)->orWhere('toSection',2)->count()}}


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
                    <h6 class="mb-3 tx-16 text-white"><a class="text-white" href="{{route('protection.admin.pendingTasks')}}">المهمات الغير
                            منجزة</a></h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','pending')->where('fromSection',2)->orWhere('toSection',2)->where('status','pending')->count()}}
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
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{route('protection.admin.completedTasks')}}">المهمات
                            المنجزة</a> </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\TaskDetails::where('section_id',2)->whereMonth('created_at', date('m'))->count()}}
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
                                {{\App\Models\TaskDetails::where('section_id','2')->count()}}
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
<div class="row row-sm ">

    {{-- المهمات الصادرة --}}
    <div class="col-xl-4 col-md-12 col-lg-6">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" id="btn-local">Local</button>
            <button type="button" class="btn btn-secondary" id="btn-incoming">incoming</button>
            <button type="button" class="btn btn-secondary" id="btn-common">common</button>
        </div>
        <div class="card">
            <div class="card-header text-center ">
                <h5 class="border-bottom py-3 text-center">المهمات المنشئة</h6>
            </div>
            <div class="d-none" id="div-local">
                <livewire:local-tasks />
            </div>
        </div>
        <div class="card">

            <div class="d-none" id="div-incoming">
                <livewire:incoming-tasks />

            </div>
        </div>
        <div class="card">
       
            <div class="d-none" id="div-common">
                <livewire:common-tasks />

            </div>
        </div>
    </div>
    {{-- التقارير  --}}
    <div class="col-xl-8 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header pb-1">
                <h5 class="border-bottom py-3 text-center"> تقارير شهر {{$monthName}}</h5>

            </div>
            <livewire:show-reports />

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