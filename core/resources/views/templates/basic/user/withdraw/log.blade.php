@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="col-lg-12 ">
                    <form>
                        <div class="d-flex justify-content-end ms-auto table--form mb-3 flex-wrap">
                            <div class="input-group">
                                <input class="form-control" name="search" type="text" value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                                <button class="input-group-text bg-base text-white">
                                    <i class="las la-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table--responsive">
                                <table class="style--two table">
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
                                                    <button class="btn base--bg btn-sm detailBtn"
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
                            </div>
                        </div>
                        @if ($withdraws->hasPages())
                            <div class="card-footer">
                                {{ paginateLinks($withdraws) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- APPROVE MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content section--bg">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush payment-list userData">

                    </ul>
                    <div class="feedback"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .btn:hover {
            border-color: unset;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var userData = $(this).data('user_data');
                console.log(userData);
                var html = ``;
                userData.forEach(element => {
                    if (element.type != 'file') {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>${element.name}</span>
                            <span">${element.value}</span>
                        </li>`;
                    } else {
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${element.name}</span>
                            <span"><a href="${element.value}"><i class="fa-regular fa-file"></i> @lang('Attachment')</a></span>
                        </li>`;
                    }
                });
                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title], [data-title], [data-bs-title]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        })(jQuery);
    </script>
@endpush
