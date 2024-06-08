@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="py-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="card custom--card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.data.submit') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Username')</label>
                                        <input name="username" class="form--control checkUser" type="text" value="{{ old('username') }}" required>
                                        <small class="text--danger usernameExist"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Country')</label>
                                            <select class="form--control select2" name="country" required>
                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}" data-code="{{ $key }}" value="{{ $country->country }}">
                                                        {{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Mobile')</label>
                                            <div class="input-inner">
                                                <span class="input-inner__icon mobile-code"></span>
                                                <input name="mobile_code" type="hidden">
                                                <input name="country_code" type="hidden">
                                                <input name="mobile" class="form--control checkUser" type="number" value="{{ old('old') }}" required>
                                            </div>
                                            <small class="text--danger mobileExist"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Address')</label>
                                            <input class="form-control form--control" name="address" type="text" value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('State')</label>
                                            <input class="form-control form--control" name="state" type="text" value="{{ old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Zip Code')</label>
                                            <input class="form-control form--control" name="zip" type="text" value="{{ old('zip') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('City')</label>
                                            <input class="form-control form--control" name="city" type="text" value="{{ old('city') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn--base w-100" type="submit">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush
@push('style')
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid hsl(var(--white) / 0.1) !important;
            border-radius: 0.375rem !important;
            padding: 0.75rem 0.75rem !important;
            height: 100% !important;
            background-color: transparent !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px !important;
        }

        span.selection {
            width: 100%;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff;
            line-height: 28px;
        }

        .select2-results__option--selectable {
            color: #000 !important;
        }

        .select2-container--open .select2-selection.select2-selection--single,
        .select2-container--open .select2-selection.select2-selection--multiple {
            border-color: #ac7a35 !important;
            border-radius: 0.375rem !important;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {

            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif
            $('.select2').select2();

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value, name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value, name);
            });

            function checkUser(value, name) {
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code: $('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush
