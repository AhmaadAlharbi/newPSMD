@extends('layouts.master')
@section('css')
<style>
.mew-logo {
    width: 250px;
}

.kuwait {
    visibility: hidden;
}


#table1,
#table2 {
    direction: ltr;
}

.ssname-table {
    direction: ltr;

}

#table0 th,
#table1 th,
#table2 th {
    font-size: 20px;
}

.print-title {
    background: #e6e6e8 !important;
}

#table0 td,
#table1 td,
#table2 td,
    {

    font-size: 19px;
}


/* #table th,
#table td {
    transform: rotate(-90deg);
} */

td {
    height: 50px;
}
</style>
<style>
@media print {
    #print_Button {
        display: none;
    }

    body {
        -webkit-print-color-adjust: exact !important;
    }



    #table1 th,
    #table2 th,
    .print-title {
        background: #e6e6e8 !important;
    }

    #table1 td,
    #table2 td,
        {
        font-size: 19px;
    }



}
</style>
@endsection
@section('page-header')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                report</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div class="test row row-sm " id="print">
    <div class="col-md-12 col-xl-12 ">
        <div class=" main-content-body-invoice border border-dark">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">

                        <div class="billed-from">

                        </div><!-- billed-from -->

                        <div class="billed-from">
                            <img class="mew-logo rounded " src="https://www.mew.gov.kw/images/logo@2x.png"
                                alt="mew logo">
                        </div><!-- billed-from -->

                    </div><!-- invoice-header -->


                    <div class="container">
                        <div class="d-block p-3  print-title text-dark">
                            <p class="text-center">Primary substation maintenance department</p>

                            <h2 class="text-center "> Trouble shooting Report</h2>
                            <h5 class="text-center m-1"><ins>Ref.No: {{$task_details->tasks->refNum}}</ins></h5>

                        </div>

                        {{-- --}}
                        <div class="table-responsive text-left">

                            <div class="text-left">
                                <h3>Alarm Date</h3>
                                <h5>{{$task_details->tasks->task_date}}</h5>
                            </div>
                            <div class="text-left">
                                <h3>Report Date</h3>
                                <h5>{{$task_details->report_date}}</h5>
                            </div>
                            <div class="row ssname-table">
                                <div class="col-sm-12 col-md-4">
                                    <h1
                                        class="d-none d-sm-block text-center mt-2 display-4 p-5 h-100 bg-dark text-white">
                                        {{$task_details->tasks->station->SSNAME}}
                                    </h1>
                                    <h1 class="d-md-none  p-3 text-center mt-2  bg-dark text-white">
                                        {{$task_details->tasks->station->SSNAME}}
                                    </h1>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <table class="table mt-2 p-5 border  border-dark h-100 text-center" id="table1"
                                        class="ltr-table ">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Company Make</th>
                                                <th scope="col">Contract.No</th>

                                            </tr>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$task_details->tasks->station->COMPANY_MAKE}}</td>
                                                <td>{{$task_details->tasks->station->Contract_No}}</td>

                                            </tr>
                                        </tbody>
                                        <tr>
                                            <thead class="thead-light">

                                                <th scope="col">COMMISIONING DATE</th>
                                                <th scope="col">Previous maintenance</th>
                                            </thead>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>{{$task_details->tasks->station->COMMISIONING_DATE}}</td>
                                                {{-- <td>{{$task->pm}}</td>--}}

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="d-block p-3 mb-2 bg-white text-dark">
                                <h2>:Unit</h2>
                                <h4>{{$task_details->tasks->equip}}</h4>
                            </div>
                            <div class="d-block p-3 border border-dark print-title  p-3 mt-4 mb-2  text-dark">
                                <h2>Nature of Fault</h2>


                                <h4 class="  ml-4 ">{{$task_details->tasks->problem}}</h4>
                            </div>

                            <div
                                class=" d-none d-sm-block p-5 border border-dark print-title  p-3-lg p-1 mt-4 mb-2  text-dark">
                                <h2>Action Take</h2>
                                <h4 class=" ml-4 w-auto h-25 ">{{$task_details->action_take}}</h4>
                            </div>
                            <div class="  d-md-none border border-dark print-title  px-3  p-1 mt-4 mb-2  text-dark">
                                <h2>Action Take</h2>
                                <h4 class=" ml-4 w-auto h-auto">{{$task_details->action_take}}</h4>
                            </div>

                            <div class="d-block p-3 mb-2 bg-white text-dark">
                                <h2>Engineer</h2>
                            </div>
                            <h4 class="  ml-4 ">{{$task_details->users->name}}<br>

                            </h4>
                            <p class="ml-4 lead">{{$task_details->users->email}}</p>
                        </div>

                    </div>

                    <hr class=" mg-b-40">
                    @isset($commonTasks)
                <!-- row -->
<div class="row">
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
                                <th class="border-bottom-0"> القسم </th>
                                <th class="border-bottom-0"> المهندس </th>
                                <th class="border-bottom-0"> التقرير </th>
                     
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($commonTasks as $task)
                            @php
                            $i++
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><a
                                        href="{{route('protection.admin.taskDetails',['id'=>$task->id])}}">{{$task->tasks->refNum}}</a>
                                </td>
                                <td>{{$task->tasks->station->SSNAME}}</td>
                                <td>{{$task->sectionID->section_name}}</td>
                                <td>{{$task->users->name}}</td>
                                <td><a href="{{route('protection.viewCommonReport',['id'=>$task->task_id,'section_id'=>$task->sectionID->id])}}" class="btn btn-outline-success">التقرير</a></td>

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
                @endisset
                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                            class="mdi mdi-printer ml-1"></i>طباعة</button>

                </div>

            </div>
        </div>
    </div><!-- COL-END -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script type="text/javascript">
function printDiv() {
    var printContents = document.getElementById('print').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
</script>
@endsection