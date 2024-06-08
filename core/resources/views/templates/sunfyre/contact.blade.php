@php
    $contactContent = getContent('contact_us.content', true);
    $contactElement = getContent('contact_us.element', false, null, true);
@endphp
@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <section class="contact-info pt-100 pb-50">
        <div class="container">
            <div class="info-wrapper">
                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="icon icon-Map"></i>
                    </div>
                    <div class="info-card__content">
                        <h4 class="info-card__title">@lang('Our Address')</h4>
                        <p class="info-card__desc">{{ __(@$contactContent->data_values->contact_address) }}</p>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="icon icon-Telepphone"></i>
                    </div>
                    <div class="info-card__content">
                        <h4 class="info-card__title">@lang('Call Us')</h4>
                        <ul class="info-card__list">
                            <li class="info-card__list-item">
                                <a class="info-card__list-link" href="tel:{{ @$contactContent->data_values->contact_number }}">{{ @$contactContent->data_values->contact_number }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="icon icon-Email"></i>
                    </div>
                    <div class="info-card__content">
                        <h4 class="info-card__title">@lang('Mail Us')</h4>
                        <ul class="info-card__list">
                            <li class="info-card__list-item">
                                <a class="info-card__list-link" href="mailto:{{ @$contactContent->data_values->email_address }}">{{ @$contactContent->data_values->email_address }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact py-50">
        <div class="container">
            <div class="contact-wrapper">
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="contact-form">
                            <h2 class="contact-form__title">{{ __(@$contactContent->data_values->heading) }}</h2>
                            <form method="POST" class="verify-gcaptcha">
                                @csrf
                                <div class="form-group">
                                    <label class="form--label">@lang('Full Name')</label>
                                    <div class="input-inner">
                                        <span class="input-inner__icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input name="name" type="text" class="form--control" value="{{ old('name', @$user->fullname) }}" @if ($user && $user->profile_complete) readonly @endif required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form--label">@lang('Email Address')</label>
                                    <div class="input-inner">
                                        <span class="input-inner__icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input class="form--control" name="email" type="email" value="{{ old('email', @$user->email) }}" @if ($user) readonly @endif required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form--label">@lang('Subject')</label>
                                    <div class="input-inner">
                                        <span class="input-inner__icon">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                        <input class="form--control" name="subject" type="text" value="{{ old('subject') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form--label">@lang('Message')</label>
                                    <textarea class="form--control" name="message">{{ old('message') }}</textarea>
                                </div>

                                <x-captcha />

                                <div class="form-submit mt-50">
                                    <button type="submit" class="btn btn--gradient w-100">@lang('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="contact-thumb">
                            <img src="{{ getImage('assets/images/frontend/contact_us/' . @$contactContent->data_values->image, '560x565') }}" alt="@lang('image')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
