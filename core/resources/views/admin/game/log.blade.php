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
                                    <th>@lang('User')</th>
                                    <th>@lang('User Select')</th>
                                    <th>@lang('Result')</th>
                                    <th>@lang('Invest')</th>
                                    <th>@lang('Win or fail')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ __(@$log->game->name) }}</td>
                                        <td>
                                            <span class="fw-bold">{{ @$log->user->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $log->user->id) }}"><span>@</span>{{ $log->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            @if (gettype(json_decode($log->user_select)) == 'array')
                                                {{ implode(', ', json_decode($log->user_select)) }}
                                            @else
                                                {{ __($log->user_select ?? 'N/A') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (gettype(json_decode($log->result)) == 'array')
                                                {{ implode(', ', json_decode($log->result)) }}
                                            @else
                                                @if ($log->game->alias == 'mines')
                                                    @lang('N/A')
                                                @else
                                                    {{ __($log->result) }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ gs('cur_sym') }}{{ __(showAmount($log->invest)) }} </td>
                                        <td>
                                            @if ($log->win_status != Status::LOSS)
                                                <span class="badge badge--success">@lang('Win')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('Loss')</span>
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
                    </div>
                </div>
                @if ($logs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($logs) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-search-form />
    <form>
        <div class="input-group w-auto">
            <select class="form-control win-status" name="win_status">
                <option value="">@lang('All')</option>
                <option value="1" @selected(request()->win_status == 1)>@lang('Win')</option>
                <option value="0" @selected(request()->win_status != null && request()->win_status == 0)>@lang('Loss')</option>
            </select>
            <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
@endpush

@push('style')
    <style>
        .win-status {
            width: 217px !important;
        }
    </style>
@endpush
