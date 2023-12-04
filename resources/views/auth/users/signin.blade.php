@extends('auth.users.auth-master')

@section('content')
    <h3 class="title text-center ">{{ __('login.login') }}</h3>
    <p class="tagline text-center">
        {{ __('login.do_not_account') }}
        <a href="{{ url('register') }}" class="link"> {{ __('login.sign_up') }}</a>
    </p>
    @include('layouts.partials.messages')

    @if (request('message'))
        <div class="alert alert-info">
            {{ urldecode(request('message')) }}
        </div>
    @endif
    <span class="text-info form-message-error-success">
    </span>
    <span class="text-info form-message-error-error">
    </span>
    <form action="" id="kt_sign_in_form" method="POST">
        <div class="mb-20px">
            <label class="" for="username">{{ __('login.username') }}</label>
            <input name="username" id="username" type="text" class="form-control"
                placeholder="{{ __('login.username_ph') }}">
            <span class="text-danger form-message-error-username">
            </span>
        </div>
        <div class="mb-15px">
            <div class="d-flex justify-content-between">
                <label class="" for="password">{{ __('login.password') }}</label>
                <a class="forget" href="">{{ __('login.forgot_password') }}</a>
            </div>
            <div>
                <input id="password" name="password" type="password" class="form-control"
                    placeholder="{{ __('login.password_ph') }}">
                <span class="text-danger form-message-error-password">
                </span>
            </div>
        </div>
        <div class="d-flex align-items-center mb-20px">
            <input type="checkbox" id="remember" class="form-check-input m-0">
            <label for="remember" class="remember m-0 ms-2">{{ __('login.remember_me') }}</label>
        </div>

        <button type="submit" class="btn submit-btn">{{ __('login.sign_in') }}</button>
    </form>
@endsection
