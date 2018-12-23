@extends('layouts.app')
@section('LoginOrRegister')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('ثبت نام') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <input id="name" placeholder="نام و نام خانوادگی خود را وارد کنید" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <input id="email" type="email" placeholder="ایمیل خود را وارد کنید" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <input id="password" placeholder="پسورد خود را وارد کنید" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <input id="password-confirm" placeholder="پسورد خود را دوباره وارد کنید" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group row">
                            <select id="role" type="text" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" required>
                                <option value="0">---سمت خود را انتخواب کنید---</option>
                                <option value="4">مدیر عامل</option>
                                <option value="3">رئیس</option>
                                <option value="2">کارمند</option>
                                <option value="1">خدماتی</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary">{{ __('ثبت نام') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
