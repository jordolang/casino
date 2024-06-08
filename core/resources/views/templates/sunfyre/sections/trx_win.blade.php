@php
    $trxContent = getContent('trx_win.content', true);
    $latestWinners = \App\Models\GameLog::where('win_status', '!=', 0)
        ->where('win_amo', '>', '0')
        ->take(6)
        ->with(['user', 'game'])
        ->latest('id')
        ->get();
    $transactions = \App\Models\Transaction::with('user')->latest()->limit(7)->get();
@endphp

<section class="winner-section py-50">
    <div class="container">
        <div class="section-heading">
            <h1 class="section-heading__title">{{ __(@$trxContent->data_values->heading) }}</h1>
            <p class="section-heading__desc">{{ __(@$trxContent->data_values->subheading) }}</p>
        </div>

        <div class="winner-section-wrapper">
            <div class="latest-winner">
                <h4 class="latest-winner__heading">@lang('Latest Winner')</h4>
                <div class="latest-winner__list">
                    @foreach ($latestWinners as $winner)
                        <div class="latest-winner-item">
                            <h6 class="latest-winner-item__title">{{ __($winner->user->fullname) }}</h6>
                            <div class="flex-between">
                                <p class="latest-winner-item__name">{{ __(@$winner->game->name) }}</p>
                                <h6 class="latest-winner-item__amount">{{ showAmount($winner->win_amo) }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="latest-transection">
                <div class="transection-table-scroller">
                    <table class="transection-table table table--responsive--xl">
                        <thead>
                            <tr>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Username')</th>
                                <th>@lang('Data')</th>
                                <th>@lang('Amount')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>#{{ $transaction->trx }}</td>
                                    <td>{{ $transaction->user->username }}</td>
                                    <td>{{ showDateTime($transaction->created_at) }}</td>
                                    <td>{{ showAmount($transaction->amount) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
