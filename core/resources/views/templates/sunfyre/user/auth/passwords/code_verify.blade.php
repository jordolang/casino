@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-5">
                    <div class="d-flex justify-content-center">
                        <div class="verification-code-wrapper">
                            <div class="verification-area">
                                <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form row gap-2">
                                    @csrf
                                    <p class="pt-3">@lang('A 6 digit verification code sent to your email address') : {{ showEmailAddress($email) }}</p>
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    @include($activeTemplate . 'partials.verification_code')

                                    <div class="form-group">
                                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                    </div>

                                    <div>
                                        @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                        <a href="{{ route('user.password.request') }}" class="text--base">@lang('Try to send again')</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .verification-code-wrapper {
            background-color: #0f1a24;
            border: 1px solid #{{ @gs('base_color') }}69;
        }

        .verification-code::after {
            background-color: #0f1a24;
        }

        .verification-code span {
            border: solid 1px #{{ @gs('base_color') }}69;
            color: #{{ @gs('base_color') }}69;
        }
    </style>
@endpush
