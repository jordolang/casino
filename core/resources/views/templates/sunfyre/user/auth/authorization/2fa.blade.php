@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="py-100">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <form action="{{ route('user.2fa.verify') }}" method="POST" class="submit-form">
                            @csrf

                            @include($activeTemplate . 'partials.verification_code')

                            <div class="form--group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .verification-code-wrapper {
            background-color: #0f1a24;
            border: 1px solid #{{ gs('base_color') }}69;
        }

        .verification-code::after {
            background-color: #0f1a24;
        }

        .verification-code span {
            border: solid 1px #{{ gs('base_color') }}69;
            color: #{{ gs('base_color') }}69;
        }
    </style>
@endpush
