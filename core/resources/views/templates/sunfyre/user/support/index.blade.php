@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="transection-section">
        <div class="latest-transection">
            <div class="transection-table-scroller">
                <table class="transection-table table table--responsive--xl">
                    <thead>
                        <tr>
                            <th>@lang('Subject')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Priority')</th>
                            <th>@lang('Last Reply')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supports as $support)
                            <tr>
                                <td>
                                    <a href="{{ route('ticket.view', $support->ticket) }}"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a>
                                </td>
                                <td>
                                    @php echo $support->statusBadge; @endphp
                                </td>
                                <td>
                                    @if ($support->priority == Status::PRIORITY_LOW)
                                        <span class="badge badge--warning">@lang('Low')</span>
                                    @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                        <span class="badge badge--success">@lang('Medium')</span>
                                    @elseif($support->priority == Status::PRIORITY_HIGH)
                                        <span class="badge badge--primary">@lang('High')</span>
                                    @endif
                                </td>
                                <td>{{ diffForHumans($support->last_reply) }} </td>
                                <td>
                                    <a class="btn btn--base btn--sm" href="{{ route('ticket.view', $support->ticket) }}">
                                        <i class="fa fa-desktop"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ paginateLinks($supports) }}
            </div>
        </div>
    </div>
@endsection
