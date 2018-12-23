@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('ایمیل احراز هویت تازه برای شما ارسال شد.') }}
                        </div>
                    @endif
                    {{ __('ایمیل خود را برای احراز هویت چک کنید.') }}
                    {{ __('ایمیل دریافت نکرده اید؟') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
