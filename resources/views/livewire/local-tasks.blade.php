
<div>
    @foreach($tasks as $task)
    @php
    $department =
    \App\Models\TrTasks::where(['task_id'=>$task->id])->pluck('department')->first()
    @endphp
    <div class="card-body p-0 customers mt-1">     
        <div class="list-group list-lg-group list-group-flush">
            <div class="list-group-item list-group-item-action" href="#">
                <div class="media  mt-0">
                    <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{asset('image/alert.png')}}"
                        alt="Image description">

                    <div class="media-body">
                        <div class="d-flex align-items-center">
                            <div class="mt-0">
                                <p class="text-right text-muted"> {{$task->created_at}}</p>
                               {{-- <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                    قسم {{$task->sections->section_name}} </p>--}}
                                    @unless( Auth::user()->section_id == 1)
                                    @if(isset($task->sections->section_name))
                                    <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                        قسم {{$task->sections->section_name}} </p>
                                    @else
                                    <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                        قسم {{$task->toSections->section_name}} </p>
                                    @endif
                                    @endunless
                                    @if( Auth::user()->section_id == 1)
                                    <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                        قسم {{$task->toSections->section_name}} </p>
                                    @endif
                                @if($task->status == 'waiting')
                                <span class="badge badge-warning text-white ml-2">

                                    {{$task->status}}
                                </span>
                                @else
                                <span class="badge badge-danger ml-2">

                                    {{$task->status}}
                                </span>
                                @endif
                                @if($department == 1)
                                <span class="bg-warning p-1 d-block text-center m-1">Mechanical</span>
                                @elseif($department ==2)
                                <span class="bg-info p-1 d-block text-center m-1">Chemistry</span>
                                @elseif($department == 3)
                                <span class="bg-dark text-white p-1  d-block text-center m-1">Electrical</span>
                                @endif
                     
                                @if(isset($task->eng_id))
                                <h5 class="m-1 tx-15">{{$task->users->name}}</h5>
                                @else
                                <h5 class="m-1 tx-15 text-info border  p-2">Waiting to be assigned
                                </h5>
                                @endif

                                <p class="mb-0 tx-13 text-dark">ssname: {{$task->station->SSNAME}}</p>
                                {{--check which route bases on section--}}
                                @switch(Auth::user()->section_id)
                                {{--edara--}}
                                @case(1)
                                <a href="{{route('edara.admin.taskDetails',['id'=>$task->id])}}"
                                    class=" my-2 btn btn-outline-secondary ">Read More</a>
                                    <a class="text-left btn btn-success "
                                    href="{{route('edara.updateTask',['id'=>$task->id])}}"
                                    class=" m-2 btn btn-primary btn-sm">Edit</a>
                                    @break
                                @break
                                {{--protection--}}
                                @case(2)
                                <a href="{{route('protection.admin.taskDetails',['id'=>$task->id])}}"
                                    class=" my-2 btn btn-outline-secondary ">Read More</a>
                               

                                <a class="text-left btn btn-success "
                                    href="{{route('switch.updateTask',['id'=>$task->id])}}"
                                    class=" m-2 btn btn-primary btn-sm">Edit</a>
                                    @break
                                    @case(5)
                                    {{--Transformers--}}
                                    <a href="{{route('Transformers.admin.taskDetails',['id'=>$task->id])}}"
                                        class=" my-2 btn btn-outline-secondary ">Read More</a>
                                    @if(isset($task->engineers->name))
                                    {{-- <a class="text-left btn btn-dark " href=""
                                        class=" m-2 btn btn-primary btn-sm">Resend Task</a>--}}
                                    @endif
                                    {{--  <a class="text-left btn btn-danger "
                                        href=""
                                    class=" m-2 btn btn-primary btn-sm">Action Take</a>--}}
    
                                    <a class="text-left btn btn-success "
                                        href="{{route('Transformers.updateTask',['id'=>$task->id])}}"
                                        class=" m-2 btn btn-primary btn-sm">Edit</a>    
                                     @break    
                                @case(6)
                                {{--switchgear--}}
                                <a href="{{route('switch.admin.taskDetails',['id'=>$task->id])}}"
                                    class=" my-2 btn btn-outline-secondary ">Read More</a>
                                @if(isset($task->engineers->name))
                                {{-- <a class="text-left btn btn-dark " href=""
                                    class=" m-2 btn btn-primary btn-sm">Resend Task</a>--}}
                                @endif
                                {{--  <a class="text-left btn btn-danger "
                                    href=""
                                class=" m-2 btn btn-primary btn-sm">Action Take</a>--}}

                                <a class="text-left btn btn-success "
                                    href="{{route('switch.updateTask',['id'=>$task->id])}}"
                                    class=" m-2 btn btn-primary btn-sm">Edit</a>    
                                 @break
                                 @endswitch   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-center p-3">
        {{ $tasks->links() }}
      </div>
    </div>
   

</div>

