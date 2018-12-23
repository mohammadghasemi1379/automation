@extends('layouts.app')
@section('title') اضافه کردن موضوع @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تیکت</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    <form action="{{ route('AddSubject.store') }}" method="post">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <label for="subject">عنوان</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="عنوان مورد نظر خود را وارد کنید...">
                        </div>

                        <div class="form-group">
                            <select class="form-control" id="role" name="role">
                                <option value="0">--- سمتی که عنوان برای آن است را انتخواب کنید ---</option>
                                <option value="4">مدیر عامل</option>
                                <option value="3">رئیس</option>
                                <option value="2">کارمند</option>
                                <option value="1">خدماتی</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary" value="ارسال">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
