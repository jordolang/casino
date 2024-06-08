@extends($activeTemplate . 'layouts.master')

@section('content')
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">@lang('Current Password')</label>
                                    <input type="password" class="form-control form--control" name="current_password" required autocomplete="current-password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Password')</label>
                                    <input type="password" class="form-control form--control @if (gs('secure_password')) secure-password @endif" name="password" required autocomplete="current-password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Confirm Password')</label>
                                    <input type="password" class="form-control form--control" name="password_confirmation" required autocomplete="current-password">
                                </div>
                                <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
@push('style')
    <style>
        .hover-input-popup .input-popup {
            bottom: 80% !important;
        }
    </style>
@endpush
