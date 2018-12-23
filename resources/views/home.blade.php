@extends('layouts.app')
@section('sidebar')
    {{--sidebar--}}
@endsection
@section('title') ثبت ورود و خروج @endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ Verta(now())->formatWord('l dS F') }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="btn btn-group text-light">

                        <div class="container">
                            <div class="d-inline-block col-6">
                                <a href="{{ route('enter') }}" class="btn btn-success mb-1 container">ثبت ورود</a>
                                <div class="alert alert-success" role="alert">ورود شما:
                                    @if(session('status')) {{ session('status') }} <br> <hr> @endif
                                    @if($entered == 'شما تا الان ثبت ورود نکرده اید.' || $entered == 'شما امروز وارد نشده اید'){{$entered}}@else {{Verta($entered)->formatTime()}} @endif
                                </div>
                            </div>
                            <div class="d-inline-block col-6">
                                <a href="{{ route('exit') }}" class="btn btn-danger mb-1 container">ثبت خروج</a>
                                <div class="alert alert-danger" role="alert">خروج شما:
                                    @if(session('status')) {{ session('statuses') }} <br> <hr> @endif
                                    @if($exited == 'شما هنوز خارج نشده اید.'){{$exited}}@else {{Verta($exited)->formatTime()}} @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">دسترسی سریع</div>
            <div class="card-body">
                <div class="container btn btn-group text-light">
                    <div class="d-inline-block col-6">
                        <a href="{{ route('ticket.index') }}" class="btn btn-success container mb-1">ارسال تیکت</a>
                        <div class="alert alert-success" role="alert"> تعداد تیکت های ارسالی :{{ isset($ticket) ?: '0' }}</div>
                    </div>
                    <div class="d-inline-block col-6">
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary container mb-1">مشاهده تیکت ها</a>
                        <div class="alert alert-primary" role="alert"> تعداد همه تیکت :{{ isset($ticket) ?: '0' }}</div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('title2') ثبت ورود و خروج @endsection
@section('content2')
<div class="row">

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
            <div class="card-header bg-secondary text-light">کارمندان مربوطه و زیرمجموعه</div>
            @foreach($staffs as $staff)
                <ul class="list-group list-group-flush bg-light">
                    <li class="list-group-item bg-light"><a href="#">{{ $staff->name }}</a></li>
                </ul>
            @endforeach
        </div>
    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-header"></div>

        </div>
    </div>
</div>
@endsection
