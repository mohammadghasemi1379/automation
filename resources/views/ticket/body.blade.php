@extends('layouts.app')
@section('title')متن پیام خود را بنویسید@endsection
@section('content')
    <form action="{{route('TicketBody.store')}}" method="post">
        @method('post')
        @csrf
        <input type="text" name="ticketID" value="{{ $ticket->id }}" hidden>
    <div class="form-group">
        <label for="subject_chosen">عنوان انتخوابی</label>
        <input type="text" name="subject_chosen" value="{{ $ticket->subjectID }}" disabled>
    </div>

    <div class="form-group">
        <label for="staff_chosen">کارمند انتخوابی</label>
        <input type="text" name="staff_chosen" value="{{ $ticket->receiver_id }}" disabled>
    </div>

    <div class="form-group">
        <label for="TicketBody">متن تیکت</label>
        <textarea class="form-control" id="TicketBody" rows="3" name="TicketBody" placeholder="متن تیکت خود را وارد کنید"></textarea>
    </div>

    <input type="submit" class="btn btn-primary" value="ارسال">
@endsection
