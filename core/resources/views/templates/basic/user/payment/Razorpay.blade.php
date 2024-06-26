@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="card-title">@lang('Razorpay')</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush payment-list">
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You have to pay '):
                                    <strong>{{ showAmount($deposit->final_amount, currencyFormat: false) }} {{ __($deposit->method_currency) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You will get '):
                                    <strong>{{ showAmount($deposit->amount) }}</strong>
                                </li>
                            </ul>
                            <form action="{{ $data->url }}" method="{{ $data->method }}">
                                <input type="hidden" custom="{{ $data->custom }}" name="hidden">
                                <script src="{{ $data->checkout_js }}"
                                        @foreach ($data->val as $key => $value)
                                data-{{ $key }}="{{ $value }}" @endforeach></script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .razorpay-payment-button {
            border: none;
        }

        .razorpay-payment-button:hover {
            border: none;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('input[type="submit"]').addClass("cmn-btn w-100 mt-3");
        })(jQuery);
    </script>
@endpush
