@extends('layouts.app')
@section('title')  تیکت شما @endsection
@section('content')

<div class="row justify-content-center" >
    <div class="col-8 p-2">
        <div style="height: 500px;overflow-y: auto;" class="p-2">
            @if(!empty($tickets) && !empty($subject->subject))
            <div class="float-none font-weight-bold text-primary" > عنوان انتخاب شده: <?php echo $subject->subject; ?></div>
            <hr>
            <div id="myChat" class="p-2" >
            @foreach($tickets as $ticket)
                @if($ticket->sender_id == $user->id || $ticket->receiver_id == $user->id)
                    @if($ticket->sender_id == $user->id)
                        <div class="row mr-3">
                            <div class="col-5 alert alert-dark float-right">
                                <p>{{ $ticket->body }}</p>
                                <span class="float-left d-inline text-left text-dark" style="font-size: 12px; letter-spacing:-0.1em;">@if($ticket->status == 0) &#10003; @else  &#10003;&#10003;@endif</span>
                            </div>
                        </div>
                    @endif
                    @if($ticket->receiver_id == $user->id)
                        <div class="row">
                            <div class="col-6 float-right d-block"></div>
                            <div class="col-5 alert alert-primary float-left d-block text-dark">{{$ticket->body}}</div>
                        </div>
                    @endif
                @else
                    <div class="row">
                        <div class="col-6 alert alert-dark float-right d-block text-dark"><?php echo $subject->subject; ?></div>
                    </div>
                @endif
            @endforeach
            </div>
            <div class="row mr-3 p-2">
                <div class="col-5  alert alert-dark float-left d-block text-dark">
                    <form action="{{route('answers')}}" method="post">
                        @method('POST')
                        @csrf
                        <input type="text" value="{{$ticket->sender_id}}" name="receiver_id" hidden>
                        <input type="text" value="{{$ticket->subject_id}}" name="subject_id" hidden>
                        <div class="form-group">
                            <label for="body">جواب تیکت:</label>
                            <textarea name="body" class="form-control" id="body" rows="3"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary container" value="ارسال">
                    </form>
                </div>
            </div>
                @else
                <div class="alert alert-danger text-center"><?php echo $subject->subject; ?> - یا برای شما ارسال نشده است </div>
            @endif
        </div>
        <script>
            var myChatter = document.getElementById("myChat");
            myChatter.scrollTop = myChatter.scrollHeight;
        </script>
    </div>
</div>

@endsection
