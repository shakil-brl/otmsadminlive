@extends('auth.users.auth-master')

@section('content')
    <h3 class="title text-center ">{{ __('register.sign_up') }}</h3>
    <p class="tagline text-center">
        {{ __('register.already_acount') }}
        <a href="{{ url('login') }}" class="link"> {{ __('login.sign_in') }}</a>
    </p>
    @include('layouts.partials.messages')
    <span class="text-info form-message-error-success">
    </span>
    <form action="" id="register_form" method="POST">
        <div class="mb-20px">
            <label class="" for="username">{{ __('register.fname') }}</label>
            <input id="fname" name="fname" type="text" class="form-control"
                placeholder="{{ __('register.fname_ph') }}">
            <span class="text-danger form-message-error-fname">
            </span>
        </div>
        <div class="mb-20px">
            <label class="" for="username">{{ __('register.lname') }}</label>
            <input id="lname" name="lname" type="text" class="form-control"
                placeholder="{{ __('register.lname_ph') }}">
            <span class="text-danger form-message-error-lname">
            </span>
        </div>
        <div class="mb-20px">
            <label class="" for="email">{{ __('register.email') }}</label>
            <input id="email" name="email" type="email" class="form-control"
                placeholder="{{ __('register.email_ph') }}">
            <span class="text-danger form-message-error-email">
            </span>
        </div>
        <div class="mb-20px">
            <label class="" for="username">{{ __('register.username') }}</label>
            <input id="username" name="username" type="text" class="form-control"
                placeholder="{{ __('register.username_ph') }}">
            <span class="text-danger form-message-error-username">
            </span>
        </div>
        <div class="mb-20px">
            <label class="" for="password">{{ __('register.password') }}</label>
            <input id="password" name="password" type="password" class="form-control"
                placeholder="{{ __('register.password_ph') }}">
            <span class="text-danger form-message-error-password">
            </span>
            <small class="d-block" style="color: #3B0764;">{{ __('register.password_requirement') }}</small>
        </div>

        <div class="mb-15px">
            <label class="" for="confirm_password">{{ __('register.repeat_password') }}</label>
            <div>
                <input id="confirm_password" name="confirm_password" type="password" class="form-control"
                    placeholder="{{ __('register.repeat_password') }}">
                <span class="text-danger form-message-error-confirm_password">
                </span>
            </div>
        </div>
        <button type="submit" class="btn submit-btn  show-loader ">{{ __('login.sign_up') }}</button>
    </form>
@endsection
