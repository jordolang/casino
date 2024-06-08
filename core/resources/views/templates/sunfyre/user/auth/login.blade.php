@extends($activeTemplate . 'layouts.app')
@section('app')
    @php
        $loginContent = getContent('login.content', true);
    @endphp

    <section class="account py-50 accout-bg">
        <div class="container">
            <div class="account-inner">
                <div class="account-form">
                    <div class="account-form__content ">
                        <a href="{{ route('home') }}" class="account-form__logo">
                            <img src="{{ siteLogo() }}" alt="@lang('image')">
                        </a>
                        <p class="account-form__desc">{{ __(@$loginContent->data_values->heading) }}</p>
                    </div>

                    <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                        @csrf
                        <div class="form-group">
                            <label class="form--label">@lang('Username or Email')</label>
                            <div class="input-inner">
                                <span class="input-inner__icon"><i class="fas fa-user"></i></span>
                                <input name="username" class="form--control" type="text" value="{{ old('username') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Password')</label>
                            <div class="input-inner">
                                <span class="input-inner__icon"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form--control" required>
                            </div>
                        </div>

                        <x-captcha />

                        <div class="form-group">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="form--check">
                                    <input class="form-check-input" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">@lang('Remember Me') </label>
                                </div>
                                <a href="{{ route('user.password.request') }}" class="forgot-password">@lang('Forget Password?')</a>
                            </div>
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn btn--gradient w-100">@lang('Submit')</button>
                        </div>
                    </form>

                    @include($activeTemplate . 'partials.social_login')
                    @if (gs('registration'))
                        <div class="d-flex flex-wrap justify-content-center mt-3">
                            <div class="account-note">@lang('Haven\'t an Account?')
                                <a href="{{ route('user.register') }}">@lang('Create Account')</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('style')
    <style>
        .social-list__link {
            background: var(--base-gradient);
            color: hsl(var(--black));
            border: 0;
        }
    </style>
@endpush
