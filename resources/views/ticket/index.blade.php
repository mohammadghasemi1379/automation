@extends('layouts.app')
@section('sidebar')
@if($MyRole = 4)
<li class="list-group-item text-light bg-dark border-0">
<a class="list-group-item text-light bg-dark" href="{{ route('AddSubject.index') }}"> اضافه کردن عنوان </a>
</li>
@endif
@endsection

@section('title')ارسال تیکت@endsection
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card">
        <div class="card-header">ارسال تیکت</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form action="{{ route('ticket.store') }}" method="post">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="subjectID">انتخواب عنوان</label>
                    <input type="text" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label for="receiver_id">انتخواب کارمند</label>
                    <select class="form-control" id="receiver_id" name="receiver_id">
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">متن پیام</label>
                    <textarea name="body" class="form-control" id="body" rows="5"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="ارسال">

            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection()
@section('title2')همه تیکت های شما@endsection
@section('content2')
<div class="row justify-content-center">
<div class="col-12">
    <div class="card">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ارسال یا دریافت شده</th>
                    <th scope="col">عنوان پیام</th>
                    <th scope="col"> متن پیام</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i=1;
                ?>
                @foreach ($ticket as $tickets)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td><a href="ticket/answer/{{$tickets->subject_id}}">@if($tickets->reciever_id = Auth::user()->id) ارسال شده @else  دریافت شده@endif</a></td>
                        <td><a href="ticket/answer/{{$tickets->subject_id}}">{{ App\Subject::where('id' , $tickets->subject_id)->first()->subject}}</a></td>
                        <td><a href="ticket/answer/{{$tickets->subject_id}}">{{ str_limit($tickets->body, 30)}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
