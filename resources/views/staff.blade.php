@extends('layouts.app')

@section('title')کارمند انتخاب شده @endsection
@section('content')
<div class="row">
    <div class="col-md-10 container">
        <div class="card">
            <div class="card-header bg-dark text-light">{{ DB::table('users')->where('id' , $id)->first()->name }}</div>
            <div class="card-body bg-dark text-center">
                @foreach($tasks as $task)
                    <ul class="list-group bg-dark p-2">
                        <li class="list-group-item bg-secondary mt-2 text-right text-light">{{Verta($task->created_at)->formatWord('l dS F')}}</li>
                        <li class="list-group-item"> ورود :{{Verta($task->created_at)->formatTime()}}</li>
                        <li class="list-group-item "> خروج :{{Verta($task->updated_at)->formatTime()}}</li>
                    </ul>
                    {{ $tasks->links() }}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
