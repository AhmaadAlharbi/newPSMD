<<!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Troubleshooting Report</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
        <style>
        .mew-logo {
            width: 250px;
        }

        /** LOADING */

        .loader {
            color: #ffb300;
            font-size: 90px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            margin: 72px auto;
            position: relative;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            animation: load6 1.7s infinite ease, round 1.7s infinite ease;
        }

        @-webkit-keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }

            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }

            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }

            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }

        @keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }

            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }

            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }

            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }

        @-webkit-keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        body {
            font-family: 'Cairo', sans-serif;
        }
        </style>
    </head>

    <body>





        <!-- row -->
        <div class="row">
            @if (session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{route('Transformers.SubmitEngineerReport',['id'=>$tasks->id])}}"
                            enctype="multipart/form-data" method="post" autocomplete="off"> @csrf
                            @if ($tasks->status == 'completed')
                            <div class="text-center">
                                <h2 class="text-info text-center">The Report is completed </h2>
                                <div class="p-4 mb-2 bg-info text-white">
                                    <h2> لرؤية تقاريرك والتعديل عليها يرجى التسجيل في الموقع بالايميل الوزاري
                                    </h2>
                                </div>
                                <a class="btn btn-success btn-lg p-3" href="" role="button">Register</a>

                                <a class="btn btn-outline-info btn p-3" href="" role="button">Home
                                    page</a>
                            </div>
                            @else
                            {{-- 1 --}}
                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class=" main-content-body-invoice">
                                        <div class="card card-invoice">
                                            <div class="card-body">
                                                <div class="invoice-header">
                                                    <div class="billed-from">
                                                        <img class=" rounded float-left"
                                                            src="https://www.mew.gov.kw/images/logo2@2x.png"
                                                            alt="mew logo">
                                                    </div><!-- billed-from -->

                                                    <div class="billed-from">
                                                        <img class="mew-logo rounded float-right"
                                                            src="https://www.mew.gov.kw/images/logo@2x.png"
                                                            alt="mew logo">
                                                    </div><!-- billed-from -->
                                                </div><!-- invoice-header -->
                                                <div class="container">
                                                    <div class="table-responsive mg-t-40">
                                                        <h2 class="text-center m-2 text-primary">إدارة صيانة محطات
                                                            التحويل
                                                            الرئيسية</h2>
                                                        <a href="" class="btn btn-secondary">الصفحة
                                                            الرئيسية</a>


                                                        <table
                                                            class="table table-hover table-invoice table-striped table-border text-md-nowrap mb-0">
                                                            <tr>
                                                                <th class="border-bottom-0">Ref Num</th>
                                                                <td colspan="4">{{$tasks->refNum}}</td>
                                                            </tr>
                                                            <input type="hidden" name="refNum"
                                                                value="{{$tasks->refNum}}">
                                                            <tr>
                                                                <th class="border-bottom-0"> Main Alaram</th>
                                                                <td>{{$tasks->main_alarm}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0">Station</th>
                                                                <td colspan="4">{{$tasks->station->SSNAME}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0">Station Full name </th>
                                                                <td colspan="4">{{$tasks->station->fullName}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0">Make </th>
                                                                <td colspan="4">{{$tasks->station->COMPANY_MAKE}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th class="border-bottom-0">Last P.M </th>
                                                                <td colspan="4">{{$tasks->pm}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0">Control</th>
                                                                @switch($tasks->station->control)
                                                                @case("JAHRA CONTROL CENTER")
                                                                <td colspan="4" class="table-warning">
                                                                    {{$tasks->station->control}}
                                                                </td>
                                                                @break
                                                                @case("JABRIYA CONTROL CENTER")
                                                                <td colspan="4" class="table-info">
                                                                    {{$tasks->station->control}}
                                                                </td>
                                                                @break
                                                                @case("TOWN CONTROL CENTER")
                                                                <td colspan="4" class="table-danger">
                                                                    {{$tasks->station->control}}
                                                                </td>
                                                                @break
                                                                @case("SHUAIBA CONTROL CENTER")
                                                                <td colspan="4" class="table-success">
                                                                    {{$tasks->station->control}}
                                                                </td>
                                                                @break
                                                                @default
                                                                <td colspan="4" class="table-light">
                                                                    {{$tasks->station->control}}
                                                                </td>
                                                                @endswitch

                                                            </tr>

                                                            <input type="hidden" name="ssname"
                                                                value="{{$tasks->station->id}}">
                                                            <tr>
                                                                <th class="border-bottom-0">Date</th>
                                                                <td>{{$tasks->task_date}}</td>
                                                            </tr>
                                                            <input type="hidden" name="task_date"
                                                                value="{{$tasks->task_date}}">

                                                            <tr>
                                                                @if($tasks->main_alarm == "Transformer Clearance" ||
                                                                $tasks->main_alarm =="Shunt Reactor Clearance" )
                                                                <th class="border-bottom-0">Capacity</th>
                                                                @else
                                                                <th class="border-bottom-0">Voltage Level</th>
                                                                @endif
                                                                <td>{{$tasks->voltage_level}}</td>

                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0">Bay Unity</th>
                                                                <td colspan="4">{{$tasks->equip}}</td>

                                                            </tr>
                                                            <input type="hidden" name="equip" value="{{$tasks->equip}}">

                                                            <tr>
                                                                <th class="border-bottom-0">Nature of Fault</th>
                                                                <td colspan="4">{{$tasks->problem}}</td>
                                                            </tr>
                                                            <input type="hidden" name="problem"
                                                                value="{{$tasks->problem}}">

                                                            <tr>
                                                                <th>ملاحظات</th>
                                                                <td colspan="4">{{$tasks->notes}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0 wd-40p">Engineer</th>
                                                                <td colspan="3">{{$tasks->users->name}}</td>
                                                            </tr>
                                                            <input type="hidden" name="eng_id"
                                                                value="{{$tasks->users->id}}">
                                                            <input class="form-control fc-datepicker" name="report_Date"
                                                                placeholder="YYYY-MM-DD" type="hidden"
                                                                value="{{ date('Y-m-d') }}" readonly required>
                                                        </table>
                                                    </div>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#exampleModal">
                                                        لم يتم الإنجاز؟
                                                    </button>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleTextarea">Action Take</label>
                                                            <textarea class="form-control" id="exampleTextarea"
                                                                name="action_take" rows="3"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">المرفقات</h5>
                                                            {{--show Attahcments --}}
                    <div class="table-responsive mt-15">
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
                                @foreach ($task_attachments as $attachment)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $attachment->file_name }}</td>
                                    <td>{{ $attachment->created_at }}</td>
                                    <td>
                                        @if($attachment->Created_by =="")
                                        {{$task->engineers->name}}
                                        @else
                                        {{ $attachment->Created_by }}
                                        @endif
                                    </td>
                                    <td colspan="2">

                                        <a class="btn btn-outline-success btn-sm"
                                            href="{{route('transformers.view_file',['id'=> $attachment->id_task,'file_name'=>$attachment->file_name])}}"
                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                            عرض</a>

                                            <a class="btn btn-outline-info btn-sm"
                                            href="{{route('transformers.download_file',['id'=> $attachment->id_task,'file_name'=>$attachment->file_name])}}"
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
                                                            <div class="col-sm-12 col-md-12">
                                                                <input type="file" name="pic[]" class="dropify"
                                                                    accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                                    data-height="70" />
                                                            </div><br>

                                                            <div class="col-sm-12 col-md-12">
                                                                <input type="file" name="pic[]" class="dropify"
                                                                    accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                                    data-height="70" />

                                                            </div><br>
                                                             <div class="text-center mb-3">
                                                                <button id="showAttachment"
                                                                    class="btn btn-outline-info">اضغط لإضافة المزيد من
                                                                    المرفقات</button>
                                                                <button id="hideAttachment"
                                                                    class="btn d-none btn-outline-info">اضغط  لإخفاء
                                                                    المزيد
                                                                    من
                                                                    المرفقات</button>

                                                            </div>
                                                            <div id="attachmentFile" class="d-none">
                                                                <div class="col-sm-12 col-md-12">
                                                                    <input type="file" name="pic[]" class="dropify"
                                                                        accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                                        data-height="70" />
                                                                </div><br>
                                                                <div class="col-sm-12 col-md-12">
                                                                    <input type="file" name="pic[]" class="dropify"
                                                                        accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                                        data-height="70" />
                                                                </div><br>
                                                                <div class="col-sm-12 col-md-12">
                                                                    <input type="file" name="pic[]" class="dropify"
                                                                        accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                                        data-height="70" />
                                                                </div><br>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal3">ارسال البيانات</button>
                                                    <!-- Loading Modal -->
                                                    <div class="modal fade" id="exampleModal3" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">
                                                                    <h5 class="modal-title" id="exampleModalLabel">جاري
                                                                        إرسال البيانات</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-center mt-2 text-warning">
                                                                        Loading...Please wait</h5>
                                                                    <div class="loader">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> سبب عدم الإنجاز </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <form action="{{route('battery.engineerReportUnCompleted',['id'=>$tasks->id])}}"
                                    method="post">
                                    {{ csrf_field() }}
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"> اختر السبب</label>
                                    <select name="reason" class="form-control" id="exampleFormControlSelect1">
                                        <option value="مسؤولية جهة آخرى">مسؤولية جهة آخرى</option>
                                        <option value="تحت الكفالة">تحت الكفالة</option>
                                        <option value="قطع غيار غير متوفرة "> قطع غيار غير متوفرة </option>
                                        <option value="بإنتظار إصلاحات"> بإنتظار إصلاحات</option>
                                        <option value="تحويل المهمة لمهندس آخر">تحويل المهمة لمهندس آخر </option>
                                        <option value="آخرى"> آخرى</option>
                                    </select>
                                    <!--Take all these hidden value to the form-->
                                    <input type="hidden" class="form-control" id="inputName" name="refNum"
                                        value="{{$tasks->refNum}}" readonly>
                                    <input type="hidden" class="form-control" readonly name="ssname" id="ssname"
                                        value="{{$tasks->station->id}}">
                                    <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                        type="hidden" value="{{ $tasks->task_Date}}" readonly required>
                                    <input type="hidden" class="form-control" readonly name="equip" id="equip"
                                        value="{{$tasks->equip}}">
                                    <input type="hidden" class="form-control" readonly value="{{$tasks->problem}}"
                                        name="problem" id="problem">
                                    <input class="form-control fc-datepicker" name="report_Date"
                                        placeholder="YYYY-MM-DD" type="hidden" value="{{ date('Y-m-d') }}" readonly
                                        required>
                                    <input type="hidden" class="form-control" name="eng_name" readonly
                                        value="{{$tasks->users->name}}">
                                    <textarea type="hidden" style="display:none;" class="form-control"
                                        id="exampleTextarea" name="notes" readonly rows="3">{{$tasks->notes}}</textarea>
                                    <!--END Taking all these hidden value to the form-->

                                    <label for="exampleTextarea">ملاحظات</label>
                                    <textarea class="form-control" id="exampleTextarea" name="engineer_note"
                                        rows="3"></textarea>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>

                        </div>

                        <!-- row closed -->
                    </div>
                    <!-- Container closed -->
                </div>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </body>
    <script>
    //to toggle files atthachmant
    const showAttachment = document.getElementById('showAttachment');
    const hideAttachment = document.getElementById('hideAttachment');
    const attachmentFile = document.getElementById('attachmentFile');
    showAttachment.addEventListener('click', e => {
        e.preventDefault();
        hideAttachment.classList.toggle('d-none');
        showAttachment.classList.toggle('d-none');
        attachmentFile.classList.toggle('d-none');
    })
    hideAttachment.addEventListener('click', e => {
        e.preventDefault();
        hideAttachment.classList.toggle('d-none');
        showAttachment.classList.toggle('d-none');
        attachmentFile.classList.toggle('d-none');
    })
    </script>

    </html>