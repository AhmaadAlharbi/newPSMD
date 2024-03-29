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
                <div>
                    <label for="" class="mt-4">عرض المهمات حسب </label>
                    <form action="{{route('dashboardControl.admin.protection')}}" method="get" onchange="this.form.submit()">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <select name="control" id="control" class="form-control">
                                    <!--placeholder-->
                                    <option >اختر التحكم لعرض المهام والتقارير</option>
                                    <option value="SHUAIBA CONTROL CENTER"{{($control == 'SHUAIBA CONTROL CENTER' )? 'selected' : ''}}>تحكم الشعيبة</option>
                                    <option value="JABRIYA CONTROL CENTER" {{($control == 'JABRIYA CONTROL CENTER' )? 'selected' : ''}}>تحكم الجابرية  </option>
                                    <option value="JAHRA CONTROL CENTER" {{($control == 'JAHRA CONTROL CENTER' )? 'selected' : ''}}>تحكم الجهراء</option>
                                    <option value="TOWN CONTROL CENTER" {{($control == 'TOWN CONTROL CENTER' )? 'selected' : ''}}>تحكم المدينة</option>
                                    <option value="NATIONAL CONTROL CENTER" {{($control == 'NATIONAL CONTROL CENTER' )? 'selected' : ''}}> تحكم الوطني</option>
                                    <option value="all">الكل</option>

                                </select>
                            </div>
                            <div class="col-2">
                                <input class="btn btn-outline-primary" type="submit" value="ابحث">

                            </div>
                        </div>
                    </form>
                </div>
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
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
                                    {{\App\Models\Task::whereMonth('created_at',
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
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
                                    {{\App\Models\TaskDetails::where('section_id',2)->whereMonth('created_at',
                                    date('m'))->count()}}
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
        <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
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
        <div class="col-xl-6 col-lg-12 col-md-12 col-xm-12">
            <div class="card overflow-hidden sales-card bg-secondary">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-16 text-white">
                            <a class="text-white" href="{{route('protection.showDuty')}}">تقارير الخفارة</a>
                        </h6>
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{\App\Models\Task::where('section_id','2')->where('status','duty')->count()}}
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
                <span id="compositeline4" class="pt-1">.</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm ">

        {{-- المهمات الصادرة --}}
        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="btn-group " role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary tablinks" id="btn-local"
                        onclick="showTab(event, 'div-local')">المهمات المنشئة</button>
                <button type="button" class="btn btn-secondary tablinks" id="btn-incoming"
                        onclick="showTab(event, 'div-incoming')">المهمات الواردة</button>
                <button type="button" class="btn btn-secondary tablinks" id="btn-common"
                        onclick="showTab(event, 'div-common')">المهمات الصادرة</button>
            </div>

            @foreach ($tasks as $task)
                @php
                    $department = \App\Models\TrTasks::where(['task_id' => $task->id])
                    ->pluck('department')
                    ->first();
                    $TaskDetails = \App\Models\TaskDetails::where('section_id',$task->section_id)
                    ->whereNotNull('reasonOfUncompleted')
                    ->get();

                @endphp
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
                                            {{-- <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                                قسم {{$task->sections->section_name}} </p>--}}
                                            @unless(Auth::user()->section_id == 1)
                                                @if (isset($task->sections->section_name))
                                                    <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                                        قسم {{ $task->sections->section_name }} </p>
                                                @else
                                                    <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                                        قسم {{ $task->toSections->section_name }} </p>
                                                @endif
                                            @endunless
                                            @if (Auth::user()->section_id == 1)
                                                <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                                    قسم {{ $task->toSections->section_name }} </p>
                                            @endif
                                            @if ($task->status == 'waiting')
                                                <span class="badge badge-warning text-white ml-2">

                                    {{ $task->status }}
                                </span>
                                            @else
                                                <span class="badge badge-danger ml-2">
                                    {{ $task->status }}
                                </span>
                                            @endif
                                            @if ($department == 1)
                                                <span class="bg-warning p-1 d-block text-center m-1">Mechanical</span>
                                            @elseif($department == 2)
                                                <span class="bg-info p-1 d-block text-center m-1">Chemistry</span>
                                            @elseif($department == 3)
                                                <span class="bg-dark text-white p-1  d-block text-center m-1">Electrical</span>
                                            @endif

                                            @if (isset($task->eng_id))
                                                <h5 class="m-1 tx-15">{{ $task->users->name }}</h5>
                                            @else
                                                <h5 class="m-1 tx-15 text-info border  p-2">Waiting to be assigned
                                                </h5>
                                            @endif

                                            <p class="mb-0 tx-13 text-dark">ssname: {{ $task->station->SSNAME }}</p>
                                            {{-- check which route bases on section --}}
                                            @switch(Auth::user()->section_id)
                                                {{-- edara --}}
                                                @case(1)
                                                    <a href="{{ route('edara.admin.taskDetails', ['id' => $task->id]) }}"
                                                       class=" my-2 btn btn-outline-secondary ">Read More</a>
                                                    <a class="text-left btn btn-success "
                                                       href="{{ route('edara.updateTask', ['id' => $task->id]) }}"
                                                       class=" m-2 btn btn-primary btn-sm">Edit</a>
                                                    @break


                                                    @break

                                                    {{-- protection --}}
                                                @case(2)
                                                    <a href="{{ route('protection.admin.taskDetails', ['id' => $task->id]) }}"
                                                       class=" my-2 btn btn-outline-secondary ">Read More</a>


                                                    <a class="text-left btn btn-success "
                                                       href="{{ route('protection.updateTask', ['id' => $task->id]) }}"
                                                       class=" m-2 btn btn-primary btn-sm">Edit</a>
                                                    @break

                                                @case(3)
                                                    <a href="{{ route('battery.admin.taskDetails', ['id' => $task->id]) }}"
                                                       class=" my-2 btn btn-outline-secondary ">Read More</a>


                                                    <a class="text-left btn btn-success "
                                                       href="{{ route('battery.updateTask', ['id' => $task->id]) }}"
                                                       class=" m-2 btn btn-primary btn-sm">Edit</a>
                                                    @break

                                                @case(5)
                                                    {{-- Transformers --}}
                                                    <a href="{{ route('Transformers.admin.taskDetails', ['id' => $task->id]) }}"
                                                       class=" my-2 btn btn-outline-secondary ">Read More</a>
                                                    @if (isset($task->engineers->name))
                                                        {{-- <a class="text-left btn btn-dark " href=""
                                                            class=" m-2 btn btn-primary btn-sm">Resend Task</a> --}}
                                                    @endif
                                                    {{-- <a class="text-left btn btn-danger " href=""
                                                        class=" m-2 btn btn-primary btn-sm">Action Take</a> --}}

                                                    <a class="text-left btn btn-success "
                                                       href="{{ route('Transformers.updateTask', ['id' => $task->id]) }}"
                                                       class=" m-2 btn btn-primary btn-sm">Edit</a>
                                                    @break

                                                @case(6)
                                                    {{-- switchgear --}}
                                                    <a href="{{ route('switch.admin.taskDetails', ['id' => $task->id]) }}"
                                                       class=" my-2 btn btn-outline-secondary ">Read More</a>
                                                    @if (isset($task->engineers->name))
                                                        {{-- <a class="text-left btn btn-dark " href=""
                                                            class=" m-2 btn btn-primary btn-sm">Resend Task</a> --}}
                                                    @endif
                                                    {{-- <a class="text-left btn btn-danger " href=""
                                                        class=" m-2 btn btn-primary btn-sm">Action Take</a> --}}

                                                    <a class="text-left btn btn-success "
                                                       href="{{ route('switch.updateTask', ['id' => $task->id]) }}"
                                                       class=" m-2 btn btn-primary btn-sm">Edit</a>
                                                    @break
                                            @endswitch
                                        </div>

                                    </div>
                                    {{-- check if there is an update on pending Task --}}
                                    @isset($pedningTask)
                                        @foreach($pedningTask as $pt)
                                            @if($task->id === $pt->task_id)
                                                <h6 class="bg-warning text-white font-weight-bold p-3 text-center">**
                                                    {{$pt->reasonOfUncompleted}}
                                                </h6>
                                            @endif
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        {{-- التقارير --}}
        <div class="mt-5 col-xl-8 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-1">
                    <h5 class="border-bottom py-3 text-center"> تقارير شهر {{$monthName}}</h5>
<div>  @foreach($tasks_reports as $task_detail)
        <div class="product-timeline card-body pt-2 mt-1 text-center ">
            <ul class="timeline-1 mb-0 ">
                <li class="mt-0 mb-0 "> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                    <!-- <p class=" badge badge-success ">{{$task_detail->status}}</p> -->
                    <p class="text-right text-muted"> {{$task_detail->created_at}}</p>
                    @if(Auth::user()->section_id == 1)
                        <p class="text-right bg-light py-2 my-2 text-center text-success font-weight-bold">قسم {{$task_detail->tasks->toSections->section_name}} </p>

                    @endif
                    <p class="p-3 mb-2 bg-dark text-white text-center">Engineer :
                        {{$task_detail->users->name}}
                    </p>

                    <p class="  bg-white text-dark text-center  "><ins>Station :
                            @php
                                //to get station id
                                $station_id =
                                \App\Models\Task::where(['id'=>$task_detail->task_id])->pluck('station_id')->first();
                            @endphp
                            {{-- To get sation SSNAME--}}
                            {{\App\Models\Station::where(['id'=>$station_id])->pluck('SSNAME')->first()}}

                        </ins></p>
                    <p class=" bg-white text-secondary font-weight-bold text-center">Nature of fault :
                        {{$task_detail->tasks->problem}}</p>
                    @if(is_null($task_detail->action_take))
                        <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                            {{$task_detail->reasonOfUncompleted}}
                        </p>
                    @else
                        <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                            {{$task_detail->action_take}}
                        </p>
                    @endif
                    @switch(Auth::user()->section_id)
                        {{--edara--}}
                        @case(1)
                            <a class="btn btn-info mt-2 text-center"
                               href="{{route('edara.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                            <a class="btn btn-outline-dark mt-2 text-center"
                               href="{{route('edara.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                            @break
                        @case(2)
                            {{--protection--}}
                            <a class="btn btn-info mt-2 text-center"
                               href="{{route('protection.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                            <a class="btn btn-outline-dark mt-2 text-center"
                               href="{{route('protection.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                            @break
                        @case(3)
                            {{--battery--}}
                            <a class="btn btn-info mt-2 text-center"
                               href="{{route('battery.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                            <a class="btn btn-outline-dark mt-2 text-center"
                               href="{{route('battery.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                            @break
                        @case(5)
                            {{--Transformers--}}
                            <a class="btn btn-info mt-2 text-center"
                               href="{{route('Transformers.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                            <a class="btn btn-outline-dark mt-2 text-center"
                               href="{{route('Transformers.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                            @break
                        @case(6)
                            {{--Transformers--}}
                            <a class="btn btn-info mt-2 text-center"
                               href="{{route('switch.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                            <a class="btn btn-outline-dark mt-2 text-center"
                               href="{{route('switch.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
                            @break
                    @endswitch
                </li>
            </ul>

        </div>
        <hr class="my-4 bg-info">
    @endforeach</div>
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
