<div>
    @foreach($common_tasks_details as $task)
    <div class="card-body p-0 customers mt-1">
        <div class="list-group list-lg-group list-group-flush">
            <div class="list-group-item list-group-item-action" href="#">
                <div class="media  mt-0">
    
                    <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{asset('image/exchange.png')}}"
                        alt="Image description">
    
                    <div class="media-body">
                        <div class="d-flex align-items-center">
                            <div class="mt-0">
                                <p class="text-right text-muted"> {{$task->created_at}}</p>
    
                                
                                <p class=" bg-light py-2 my-2 text-center text-dark font-weight-bold">
                                    قسم {{$task->toSections->section_name}} </p>
                                @if($task->status == 'waiting')
                                <span class="badge badge-warning text-white ml-2">
    
                                    {{$task->status}}
                                </span>
                                @elseif($task->status == 'pending')
                                <span class="badge badge-danger ml-2">
    
                                    {{$task->status}}
                                </span>
                                @else
                                <span class="badge badge-success ml-2">
    
                                    {{$task->status}}
                                </span>
                                @endif
                                @if(isset($task->eng_id))
                                <h5 class="m-1 tx-15">{{$task->users->name}}</h5>
                                @else
                                <h5 class="m-1 tx-15 text-info border  p-2">Waiting to be assigned
                                </h5>
                                @endif
                                <p class="mb-0 tx-13 text-dark">ssname: {{$task->station->SSNAME}}</p>
                                @switch(Auth::user()->section_id)
                                
                                @case(1)
                                {{--protection--}}
                                <a href="{{route('protection.admin.taskDetails',['id'=>$task->id])}}"
                                    class=" my-2 btn btn-outline-secondary ">Read More</a>
                                    <a href="{{route('protection.cancelTaskTraking',['id'=>$task->id])}}" 
                                        class="btn btn-outline-danger my-2">إلغاء متابعة المهمة</a>
    
                                @if($task->status === 'completed')
                                <a class="btn btn-info mt-0 text-center"
                                    href="{{route('protection.viewCommonReport',['id'=>$task->id,'section_id'=>$task->toSections->id])}}">Report</a>
                                <a class="text-left btn btn-success "
                                    href="{{route('protection.updateTask',['id'=>$task->id])}}"
                                    class=" m-2 btn btn-primary btn-sm">Edit</a>
                                @endif
                                @break
                                @case(5)
                                {{--Transformers--}}
                                <a href="{{route('Transformers.admin.taskDetails',['id'=>$task->id])}}"
                                    class=" my-2 btn btn-outline-secondary ">Read More</a>
                                    <a href="{{route('Transformers.cancelTaskTraking',['id'=>$task->id])}}" 
                                        class="btn btn-outline-danger my-2">إلغاء متابعة المهمة</a>
    
                                @if($task->status === 'completed')
                                <a class="btn btn-info mt-0 text-center"
                                    href="{{route('Transformers.viewCommonReport',['id'=>$task->id,'section_id'=>$task->toSections->id])}}">Report</a>
                                <a class="text-left btn btn-success "
                                    href="{{route('Transformers.updateTask',['id'=>$task->id])}}"
                                    class=" m-2 btn btn-primary btn-sm">Edit</a>
                                    @endif
                                @break
                                @case(6)
                                      {{--Switchgear--}}
                                      <a href="{{route('switch.admin.taskDetails',['id'=>$task->id])}}"
                                        class=" my-2 btn btn-outline-secondary ">Read More</a>
                                        <a href="{{route('switch.cancelTaskTraking',['id'=>$task->id])}}" 
                                            class="btn btn-outline-danger my-2">إلغاء متابعة المهمة</a>
        
                                    @if($task->status === 'completed')
                                    <a class="btn btn-info mt-0 text-center"
                                        href="{{route('switch.viewCommonReport',['id'=>$task->id,'section_id'=>$task->toSections->id])}}">Report</a>
                                    <a class="text-left btn btn-success "
                                        href="{{route('switch.updateTask',['id'=>$task->id])}}"
                                        class=" m-2 btn btn-primary btn-sm">Edit</a>

                                      @endif  
                                @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

        <div class="d-flex justify-content-center">
            {{$common_tasks_details->links() }}
        </div>
</div>
