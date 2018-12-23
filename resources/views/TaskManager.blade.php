@extends('layouts.app')
@section('sidebar')
    {{--sidebar--}}
@endsection
@section('title') TaskManager @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ارسال تیکت</div>
                    <div class="card-body">
                        <form action="{{ route('todo.store') }}" method="post">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="receiver_id">انتخواب کارمند</label>
                                <select class="form-control" id="receiver_id" name="receiver_id">
                                    @foreach($staffs as $staff)
                                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">متن تسک</label>
                                <input type="text" id="body" name="body" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary" value="ارسال">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-2">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-info">تسک های ارسال شده </div>
                    @foreach($tasks_send as $tasks)
                        <ul class="list-group ml-1">
                            <li class="list-group-item bg-light mt-2"> عنوان تسک: {{$tasks->body}}</li>
                            <li class="list-group-item"> ارسالی برای: {{ $staffs->where('id' , $tasks->receiver_id)->first()->name }}</li>
                            <li class="list-group-item"> وضعیت تسک: @if($tasks->status == 0) انجام نشده @elseانجام شده  @endif</li>
                        </ul>
                        <div class="container m-1">{{ $tasks_send->links() }}</div>
                    @endforeach
                </div>
            </div>


        <div class="col-md-5">
            <div class="card">
            <div class="card-header bg-warning">تسک های دریافت شده</div>
                <div class="card-body">
                    <form action="{{route('done')}}" method="post">
                        @method('POST')
                        @csrf
                        @foreach($tasks_recieve as $task)
                            <input type="radio" name="taskDone" value="{{$task->id}}"> {{$task->body}}@if($task->status == 0) "انجام نشده" @else "انجام شده" @endif <br><br>
                            <div class="container m-1">{{ $tasks_recieve->links() }}</div>
                        @endforeach
                        <input type="submit" class="btn btn-warning container" value="انجام داده شد">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
