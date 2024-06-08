@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="transection-section">
        @include($activeTemplate . 'partials.search_form')
        <div class="latest-transection">
            <div class="transection-table-scroller">
                <table class="transection-table table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Gateway | Transaction')</th>
                            <th>@lang('Initiated')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Conversion')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdraws as $withdraw)
                            @php
                                $details = [];
                                foreach ($withdraw->withdraw_information as $key => $info) {
                                    $details[] = $info;
                                    if ($info->type == 'file') {
                                        $details[$key]->value = route('user.download.attachment', encrypt(getFilePath('verify') . '/' . $info->value));
                                    }
                                }
                            @endphp
                            <tr>
                                <td>
                                    <div class="text-end text-lg-start">
                                        <span class="fw-bold"><span class="text--base"> {{ __(@$withdraw->method->name) }}</span></span>
                                        <br>
                                        <small>{{ $withdraw->trx }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span>{{ showDateTime($withdraw->created_at) }} <br> {{ diffForHumans($withdraw->created_at) }}</span>
                                </td>
                                <td>
                                    <div>
                                        {{ showAmount($withdraw->amount) }} - <span class="text--danger" data-bs-toggle="tooltip" title="@lang('Processing Charge')">{{ showAmount($withdraw->charge) }} </span>
                                        <br>
                                        <strong data-bs-toggle="tooltip" title="@lang('Amount after charge')">
                                            {{ showAmount($withdraw->amount - $withdraw->charge) }}
                                        </strong>
                                    </div>

                                </td>
                                <td>
                                    <div>
                                        {{ showAmount(1) }} = {{ showAmount($withdraw->rate, currencyFormat: false) }} {{ __($withdraw->currency) }}
                                        <br>
                                        <strong>{{ showAmount($withdraw->final_amount, currencyFormat: false) }} {{ __($withdraw->currency) }}</strong>
                                    </div>
                                </td>
                                <td>
                                    @php echo $withdraw->statusBadge @endphp
                                </td>
                                <td>
                                    <button class="btn btn--base btn--sm detailBtn"
                                            data-user_data="{{ json_encode($details) }}"
                                            @if ($withdraw->status == Status::PAYMENT_REJECT) data-admin_feedback="{{ $withdraw->admin_feedback }}" @endif>
                                        <i class="la la-desktop"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ paginateLinks($withdraws) }}
            </div>
        </div>
    </section>

    <div class="modal custom--modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content section--bg">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush payment-list userData"></ul>
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var userData = $(this).data('user_data');
                var html = ``;
                userData.forEach(element => {
                    if (element.type != 'file') {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>${element.name}</span>
                            <span">${element.value}</span>
                        </li>`;
                    }
                });
                modal.find('.userData').html(html);
                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="mt-3 text--dark">
                            <strong class="text--muted">@lang('Admin Feedback')</strong>
                            <p class="text-white">${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
