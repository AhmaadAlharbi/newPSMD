<div>
    @foreach($task_details as $task_detail)
    <div class="product-timeline card-body pt-2 mt-1 text-center ">
        <ul class="timeline-1 mb-0 ">
            <li class="mt-0 mb-0 "> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                <!-- <p class=" badge badge-success ">{{$task_detail->status}}</p> -->
                <p class="text-right text-muted"> {{$task_detail->created_at}}</p>

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
                @case(2)
                {{--protection--}}
                <a class="btn btn-info mt-2 text-center"
                    href="{{route('protection.veiwReport',['id'=>$task_detail->task_id])}}">Report</a>
                <a class="btn btn-outline-dark mt-2 text-center"
                    href="{{route('protection.admin.taskDetails',['id'=>$task_detail->task_id])}}">Details</a>
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
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $task_details->links() }}

    </div>
</div>
