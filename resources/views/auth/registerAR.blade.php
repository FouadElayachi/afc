@extends('layouts.appAR')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card droid-arabic-kufi">
                <div class="card-header text-center text-uppercase">{{ __('التسجيل') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" dir="rtl">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('البريد الإلكتروني') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name_fr" class="col-md-4 col-form-label text-md-left">{{ __('الإسم الشخصي (الفرنسية)') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="first_name_fr" type="text" class="form-control{{ $errors->has('first_name_fr') ? ' is-invalid' : '' }}" name="first_name_fr" value="{{ old('first_name_fr') }}" required>

                                @if ($errors->has('first_name_fr'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name_fr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name_fr" class="col-md-4 col-form-label text-md-left">{{ __('الإسم العائلي (الفرنسية)') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="last_name_fr" type="text" class="form-control{{ $errors->has('last_name_fr') ? ' is-invalid' : '' }}" name="last_name_fr" value="{{ old('last_name_fr') }}" required>

                                @if ($errors->has('last_name_fr'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name_fr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name_ar" class="col-md-4 col-form-label text-md-left">{{ __('الإسم الشخصي (العربية)') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="first_name_ar" type="text" class="form-control{{ $errors->has('first_name_ar') ? ' is-invalid' : '' }}" name="first_name_ar" value="{{ old('first_name_ar') }}" required>

                                @if ($errors->has('first_name_ar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name_ar" class="col-md-4 col-form-label text-md-left">{{ __('الإسم العائلي (العربية)') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="last_name_ar" type="text" class="form-control{{ $errors->has('last_name_ar') ? ' is-invalid' : '' }}" name="last_name_ar" value="{{ old('last_name_ar') }}" required>

                                @if ($errors->has('last_name_ar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('كلمة المرور') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('تأكيد كلمة المرور') }} <span class="color-theme">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تسجيل') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
