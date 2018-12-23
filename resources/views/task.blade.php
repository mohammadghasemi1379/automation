@extends('layouts.app')

@section('title')ثبت ورود و خروج@endsection
@section('content')
<div class="container">
   <div class="d-inline-block col-5">
       <a href="{{ route('enter') }}" class="btn btn-success mb-1 container">ثبت ورود</a>
       <div class="alert alert-success" role="alert">ورود شما:
           @if(session('status')) {{ session('status') }} <br> <hr> @endif
           {{  $entered }}
       </div>
   </div>
   <div class="d-inline-block col-5">
       <a href="{{ route('exit') }}" class="btn btn-danger mb-1 container">ثبت خروج</a>
       <div class="alert alert-danger" role="alert">خروج شما:
           @if(session('status')) {{ session('statuses') }} <br> <hr> @endif
           {{ $exited }}
       </div>
   </div>
</div>
@endsection

@section('title2')اطلاعات کارمندان زیر مجموعه@endsection
@section('content2')
    <div class="alert alert-danger"><ul><li>ابتدا کارمند مورد نظر را از قسمت زیر انتخواب کنید</li></ul></div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-secondary text-light">کارمندان مربوطه و زیرمجموعه</div>
                @foreach($staffs as $staff)
                    <ul class="list-group list-group-flush bg-light">
                        <li class="list-group-item bg-light"><a href="staff/{{$staff->id}}">{{ $staff->name }}</a></li>
                    </ul>
                @endforeach
            </div>
        </div>

        <div class="col-4">
            <div class="card-header bg-primary">زمان خروج و ورود در روز گذشته</div>
            <div class="alert alert-primary mb-0 border-bottom-0 rounded-0"> خروج:  {{$exited}} </div>
            <div class="alert alert-primary"> ورود: {{$entered}}</div>
        </div>

        <div class="col-4">
            <div class="card-header bg-success">زمان حضور در این هفته</div>
            <div class="alert alert-success" role="alert"> مجموع زمان حضور : {{$exited}} </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header"></div>

            </div>
        </div>
    </div>
@endsection
