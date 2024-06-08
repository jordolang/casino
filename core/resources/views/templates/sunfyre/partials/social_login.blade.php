@php
    $text = isset($register) ? 'Register' : 'Login';
@endphp
@if (@gs('socialite_credentials')->linkedin->status || @gs('socialite_credentials')->facebook->status == Status::ENABLE || @gs('socialite_credentials')->google->status == Status::ENABLE)
    <h3 class="account-form__other">
        <span class="account-form__other-line"></span>
        <span>@lang('or')</span>
    </h3>
    <ul class="social-list">
        @if (@gs('socialite_credentials')->google->status == Status::ENABLE)
            <li class="social-list__item">
                <a class="social-list__link flex-center google" href="{{ route('user.social.login', 'google') }}">
                    <i class="fab fa-google"></i>
                </a>
            </li>
        @endif
        @if (@gs('socialite_credentials')->facebook->status == Status::ENABLE)
            <li class="social-list__item">
                <a class="social-list__link flex-center facebook" href="{{ route('user.social.login', 'facebook') }}">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
        @endif
        @if (@gs('socialite_credentials')->linkedin->status == Status::ENABLE)
            <li class="social-list__item">
                <a class="social-list__link flex-center linkedin" href="{{ route('user.social.login', 'linkedin') }}">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </li>
        @endif
    </ul>
@endif

@push('style')
    <style>
        .social-login-btn {
            border: 1px solid #cbc4c4;
        }
    </style>
@endpush
