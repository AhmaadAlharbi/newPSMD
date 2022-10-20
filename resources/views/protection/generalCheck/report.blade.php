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

    td {
        font-size: 20px;
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
        #table2 th .print-title {
            background: #e6e6e8 !important;
        }

        #table1 td,
        #table2 td {
            font-size: 19px;
        }



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

                    <div class="container">
                        <div class="d-block p-3  print-title text-dark">
                            <div class="row">
                                <div class="col">
                                    <img class="mew-logo rounded " src="https://www.mew.gov.kw/images/logo@2x.png"
                                        alt="mew logo">
                                </div>
                                <div class="col">
                                    <p class="text-center">Primary substation maintenance department</p>
                                    <h2 class="text-center"> Trouble shooting Report</h2>
                                    <h5 class="text-center"><ins>Ref.No: {{ $task_details->refNum }}</ins>


                                    </h5>
                                </div>
                            </div>
                        </div>
                        {{-- --}}
                        <div class="table-responsive text-left">
                            <div class=" row ssname-table  ">
                                <div class=" d-print-none col-sm-12 col-print-12  col-lg-6  ">
                                    <h1
                                        class="d-none
                                        d-sm-flex justify-content-center align-items-center text-center rounded-lg mt-2 display-1 py-5 h-100 bg-white text-dark border border-dark">
                                        {{ $task_details->task->station_name }}
                                    </h1>
                                    <h1 style="font-size:44px;"
                                        class="d-block 
                             justify-content-center align-items-center text-center mt-2  p-5 h-100 bg-wihte text-dark border border-dark rounded-lg d-sm-none">
                                        {{ $task_details->task->station_name }}
                                    </h1>

                                </div>
                                {{-- this div show only on print --}}
                                <div class="d-none d-print-block  col-sm-4  ">
                                    <h1
                                        class="d-flex justify-content-center align-items-center text-center mt-2 p-5 h-100 bg-white text-dark border border-dark rounded-lg">
                                        {{ $task_details->task->station_name }}
                                    </h1>

                                </div>
                                <div
                                    class="d-print-none d-none d-sm-block col-sm-12  col-lg-6 col-print-12  table-responsive-sm">
                                    <table class="table mt-2 p-5 border border-dark h-100 text-center" id="table1"
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
                                                <td>{{ $task_details->task->make }}</td>
                                                <td>{{ $task_details->task->contract_number }}</td>

                                            </tr>
                                        </tbody>
                                        <tr>
                                            <thead class="thead-light">
                                                <th scope="col">COMMISIONING DATE</th>
                                                <th scope="col">contractor</th>
                                            </thead>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>-</td>
                                                <td>{{$task_details->task->contractor}}</td>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- this div show only on print --}}
                                <div class="d-none d-print-block    col-sm-8  table-responsive-sm">
                                    <table class="table mt-2 p-5 border border-dark h-100 text-center" id="table1"
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
                                                <td>{{ $task_details->task->make }}</td>
                                                <td>{{ $task_details->task->contract_number }}</td>

                                            </tr>
                                        </tbody>
                                        <tr>
                                            <thead class="thead-light">
                                                <th scope="col">COMMISIONING DATE</th>
                                                <th scope="col">contractor</th>
                                            </thead>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>-</td>
                                                <td>{{$task_details->task->contractor}}</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- mobile screen table --}}
                                <div class="d-block d-sm-none col-sm-12">
                                    <table class=" table mt-2 p-5 border border-dark h-100 text-center" id="table1"
                                        class="ltr-table ">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Company Make</th>

                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $task_details->task->make }}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <th scope="col">Contract.No</th>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $task_details->task->contract_number }}</td>

                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <th scope="col">COMMISIONING DATE</th>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>-</td>

                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <th scope="col">contractor</th>


                                        <tbody>
                                            <tr>
                                                <td>{{$task_details->task->contractor}}</td>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <div class="  border border-dark mt-3     mb-2  text-dark">
                                <h3 class="bg-warning-gradient py-3 text-white pl-4 ">Control
                                    {{ $task_details->task->created_at }}


                                </h3>
                                <h3 class="ml-4">{{$task_details->task->control}}</h3>


                            </div>

                            <div class="  border border-dark      mb-2  text-dark">
                                <h3 class="bg-success-gradient py-3 text-white pl-4 ">Report Date
                                    {{ $task_details->created_at }}
                                </h3>

                                <h2 class="ml-4">Action Take</h2>
                                @if (isset($task_details->action_take))
                                <h4 class=" ml-4 w-auto h-25 text-left">{{ $task_details->action_take }}</h4>
                                @else
                                <h4 class=" ml-4 w-auto h-25 ">{{ $task_details->reason }}</h4>
                                <h5 class=" ml-4 w-auto h-25 ">{{ $task_details->engineer_notes }}</h5>
                                @endif
                            </div>


                            <div class="d-block p-3 mb-2 bg-white text-dark">
                                <h2>Engineer</h2>
                            </div>
                            <h4 class="  ml-4 ">{{ $task_details->users->name }}<br>

                            </h4>
                            <p class="ml-4 lead">{{ $task_details->users->email }}</p>
                        </div>

                    </div>

                    <hr class=" mg-b-40">
                    <div class="btn-group mb-3 d-print-none" role="group" aria-label="Basic example">

                        <button type="button" class="btn btn-outline-info tablinks"
                            onclick="showTab(event, 'attachments')">Attachments @php echo '(' . count($task_attachment)
                            .
                            ')';
                            @endphp</button></button>
                    </div>

                    {{-- attachments table --}}
                    <div class="tabcontent table-responsive mt-15 d-print-none d-none" id="attachments">
                        <table class="table center-aligned-table mb-0  table-hover" style="text-align:center">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">م</th>
                                    <th scope="col">اسم الملف</th>
                                    <th scope="col">تاريخ الاضافة</th>
                                    <th scope="col"> بواسطة</th>
                                    <th scope="col">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($task_attachment as $attachment)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $attachment->file_name }}</td>
                                    <td>{{ $attachment->created_at }}</td>
                                    <td>
                                        @if ($attachment->Created_by == '')
                                        {{ $task->engineers->name }}
                                        @else
                                        {{ $attachment->Created_by }}
                                        @endif
                                    </td>
                                    <td colspan="2">
                                        <a class="btn btn-outline-success btn-sm"
                                            href="{{ route('protection.view_file', ['id' => $attachment->id_task, 'file_name' => $attachment->file_name]) }}"
                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                            عرض</a>

                                        <a class="btn btn-outline-info btn-sm"
                                            href="{{ route('protection.download_file', ['id' => $attachment->id_task, 'file_name' => $attachment->file_name]) }}"
                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                            تحميل</a>
                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                            data-file_name="{{ $attachment->file_name }}"
                                            data-invoice_number="{{ $attachment->id_task }}"
                                            data-id_file="{{ $attachment->id }}" data-target="#delete_file">حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
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
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
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
<script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
@endsection