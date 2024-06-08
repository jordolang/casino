@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="transection-section">
        <div class="show-filter text-end mb-3">
            <button class="btn btn--base showFilterBtn btn--sm" type="button"><i class="las la-filter"></i> @lang('Filter')</button>
        </div>
        <div class="card custom--card responsive-filter-card mb-4">
            <div class="card-body">
                <form>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Transaction Number')</label>
                            <input class="form--control" name="search" type="text" value="{{ request()->search }}">
                        </div>
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Type')</label>
                            <select class="form--control select2" name="trx_type" data-minimum-results-for-search="-1">
                                <option value="">@lang('All')</option>
                                <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Remark')</label>
                            <select class="form--control select2" name="remark" data-minimum-results-for-search="-1">
                                <option value="">@lang('Any')</option>
                                @foreach ($remarks as $remark)
                                    <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--base w-100"><i class="las la-filter"></i> @lang('Filter')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="latest-transection">
            <div class="transection-table-scroller">
                <table class="transection-table table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Trx')</th>
                            <th>@lang('Transacted')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Post Balance')</th>
                            <th>@lang('Detail')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            <tr>
                                <td>
                                    <strong>{{ $trx->trx }}</strong>
                                </td>

                                <td>
                                    {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                </td>

                                <td class="budget">
                                    <span class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                        {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                    </span>
                                </td>

                                <td class="budget">
                                    {{ showAmount($trx->post_balance) }}
                                </td>

                                <td>{{ __($trx->details) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ paginateLinks($transactions) }}
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .selection {
            display: block;
        }

        .select2-container--default .select2-selection--single {
            background-color: #0f1a24 !important;
            border: 1px solid rgba(255, 255, 255, 0.21) !important;
            border-radius: 4px;
            height: 50px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff;
            line-height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px !important;
        }

        .select2 .dropdown-wrapper {
            display: none;
        }

        .select2-dropdown {
            background-color: #0f1a24;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-results__option--selectable,
        .select2-container--default .select2-results__option--disabled {
            border-bottom: 0;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: hsl(var(--base)) !important;
        }
    </style>
@endpush
