@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="transection-section">
        <div class="latest-transection">
            <div class="transection-table-scroller">
                <table class="transection-table table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Game Name')</th>
                            <th>@lang('You Select')</th>
                            <th>@lang('Result')</th>
                            <th>@lang('Invest')</th>
                            <th>@lang('Win or Lost')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>
                                    <span class="text-end">{{ __(@$log->game->name) }}</span>
                                </td>
                                <td>
                                    <div>
                                        @if (gettype(json_decode($log->user_select)) == 'array')
                                            {{ implode(', ', json_decode($log->user_select)) }}
                                        @else
                                            {{ __($log->user_select ?? 'N/A') }}
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        @if (gettype(json_decode($log->result)) == 'array')
                                            {{ implode(', ', json_decode($log->result)) }}
                                        @else
                                            @if ($log->game->alias == 'mines')
                                                @lang('N/A')
                                            @else
                                                {{ __($log->result) }}
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td><span>{{ showAmount($log->invest) }}</span> </td>
                                <td>
                                    @if ($log->win_status != Status::LOSS)
                                        <span class="badge badge--success"><i class="las la-smile"></i> @lang('Win')</span>
                                    @else
                                        <span class="badge badge--danger"><i class="las la-frown"></i> @lang('Lost')</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ paginateLinks($logs) }}
            </div>
        </div>
    </section>
@endsection
