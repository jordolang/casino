@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Game Name')</th>
                                    <th>@lang('Minimum Invest')</th>
                                    <th>@lang('Maximum Invest')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($games as $game)
                                    <tr>
                                        <td>{{ __($game->name) }}</td>
                                        <td>{{ showAmount($game->min_limit) }}</td>
                                        <td>{{ showAmount($game->max_limit) }}</td>
                                        <td>
                                            @php
                                                echo $game->statusBadge;
                                            @endphp
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-sm btn-outline--primary"
                                                   href="{{ route('admin.game.edit', $game->id) }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
                                                @if ($game->status == Status::DISABLE)
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn"
                                                            data-action="{{ route('admin.game.status', $game->id) }}"
                                                            data-question="@lang('Are you sure to enable this game?')" type="button">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn"
                                                            data-action="{{ route('admin.game.status', $game->id) }}"
                                                            data-question="@lang('Are you sure to disable this game?')" type="button">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection
@push('breadcrumb-plugins')
    <x-search-form />
@endpush
