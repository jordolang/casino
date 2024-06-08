@extends($activeTemplate . 'layouts.app')
@section('app')
    @php
        $login = getContent('login.content', true);
    @endphp
    <section class="login-section bg_img"
             style="background-image: url( {{ getImage('assets/images/frontend/login/' . @$login->data_values->image, '1920x1280') }} );">
        <div class="login-area">
            <div class="login-area-inner">
                <div class="text-center">
                    <a class="site-logo mb-4" href="{{ route('home') }}">
                        <img src="{{ siteLogo() }}" alt="site-logo">
                    </a>
                    <h2 class="title mb-2">{{ __(@$login->data_values->title) }}</h2>
                    <p>{{ __(@$login->data_values->subtitle) }}</p>
                </div>
                <form method="POST" action="{{ route('user.login') }}" class="login-form mt-50 verify-gcaptcha">
                    @csrf
                    <div class="form-group">
                        <label>@lang('Username or Email')</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="las la-user"></i></div>
                            <input type="text" class="form-control" value="{{ old('username') }}" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('Password')</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="las la-key"></i></div>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <x-captcha />

                    <div class="form-group">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="form--check">
                                <input class="form-check-input" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">@lang('Remember Me') </label>
                            </div>
                            <a href="{{ route('user.password.request') }}" class="text--base"> @lang('Forget Password?')</a>
                        </div>
                    </div>

                    <button type="submit" id="recaptcha" class="cmn-btn rounded-0 w-100">@lang('Login Now')</button>
                </form>
                @include($activeTemplate . 'partials.social_login')
                @if (gs('registration'))
                    <div class="text-center mt-4">
                        <p>@lang("Haven't an account?") <a href="{{ route('user.register') }}" class="text--base">@lang('Create an account')</a></p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .account-form__title {
            text-align: center;
            margin-bottom: 20px;
        }

        .account-form .social-list {
            justify-content: center;
        }

        .account-form__other {
            text-align: center;
            position: relative;
            margin: 16px 0;
        }

        .account-form__other span {
            width: 50px;
            background: #01162f;
            z-index: 1;
            position: relative;
        }

        .account-form__other-line {
            position: absolute !important;
            top: 50%;
            left: 0;
            border-bottom: 1px solid rgb(255 255 255 / 30%);
            width: 100% !important;
        }

        .social-list__link {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            color: hsl(var(--white) / 0.4);
            background-color: #303a45;
            border: 2px solid rgba(255, 255, 255, 0.1);
            z-index: 1;
            transition: all linear 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .social-list__link:hover {
            background-color: #ac7a35;
            color: #01162f;
        }

        .account-form__title {
            text-align: center;
            margin-bottom: 25px;
        }

        .social-list {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>
@endpush
