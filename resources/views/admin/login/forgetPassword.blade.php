@extends('layouts.appLogin')
@section('content')

    <section class="main-area">
        <div class="container-fluid">
            <div class="row h100">
                <?php $bg_img = \App\AdminSetting::find(1)->bg_img; ?>
                <div class="col-md-6 p-0 m-none"
                    style="background: url({{ asset('storage/images/app/' . $bg_img) }}) center center;background-size: cover;background-repeat: no-repeat;">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                </div>

                <div class="col-md-6 p-0 data-box-col">
                    <div class="login">
                        <div class="center-box">
                            <div class="logo">
                                <?php $black_logo = \App\AdminSetting::find(1)->black_logo; ?>
                                <img src="{{ asset('storage/images/app/' . $black_logo) }}" class="logo-img">
                            </div>
                            <div class="title">
                                <h4 class="login_head">{{ __('Forget password') }}</h4>
                                <p class="login-para">
                                    {{ __('This is a secure system and you will need to provide your') }} <br>
                                    {{ __('Email Id to reset your password.') }}</p>
                            </div>
                            <div class="form-wrap">
                                <form role="form" class="pui-form" id="loginform" method="POST"
                                    action="{{ url('/admin/forgetpassword/change') }}">
                                    @csrf
                                    <div class="pui-form__element">
                                        <label class="animated-label">{{ __('Email') }}</label>
                                        <input id="inputEmail" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="">

                                    </div>
                                    @if ($errors->any())
                                        <h4 class="text-center text-red">{{ $errors->first() }}</h4>
                                    @endif

                                    <div class="pui-form__element">
                                        <button class="btn btn-lg btn-primary btn-block btn-salon"
                                            type="submit">{{ __('SUBMIT') }}</button>
                                    </div>
                                </form>
                                <span class="signup-label">{{ __('Back to sign in?') }} <a
                                        href="{{ url('/admin/login') }}"> {{ __('Sign In.') }} </a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
