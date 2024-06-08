@extends('admin.layouts.app')
@section('panel')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.game.keno.update', $game->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Game Name')</label>
                                    <input class="form-control" name="name" type="text" value="{{ $game->name }}"
                                           placeholder="@lang('Game Name')" required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader image="{{ $game->image }}" class="w-100" type="game" :required=false />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border--primary mb-3">
                                    <h5 class="card-header bg--primary">@lang('Bet Amount & Number')</h5>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>@lang('Minimum Invest Amount')</label>
                                            <div class="input-group">
                                                <input class="form-control" name="min" type="number" value="{{ getAmount($game->min_limit) }}" step="any" min="1" required>
                                                <span class="input-group-text">{{ gs('cur_text') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Maximum Invest Amount')</label>
                                            <div class="input-group">
                                                <input class="form-control" name="max" type="number" value="{{ getAmount($game->max_limit) }}" step="any" min="1" required>
                                                <span class="input-group-text">{{ gs('cur_text') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('How many number user can select')?</label><span class="fw-bold text--danger px-1"
                                                  title="@lang('This number means how many numbers a user can select from the Keno number plate and you have to put a number above 3, mainly the Keno game provides 10')"><i class="las la-question-circle"></i></span>
                                            <div class="input-group">
                                                <input class="form-control" name="max_select_number" type="number" value="{{ getAmount(@$game->level->max_select_number ?? 10) }}" min="4">
                                                <span class="input-group-text">@lang('Qty')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border--primary">
                                    <h5 class="card-header bg--primary">@lang('Win Chance')</h5>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>@lang('Winning Chance')</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" name="probable" type="number" value="{{ getAmount($game->probable_win) }}">
                                                <span class="input-group-text">@lang('%')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card border--primary mb-3">
                                    <h5 class="card-header bg--primary">@lang('Win Bonus') <span
                                              class="text--danger fw-bold" title="@lang('When the user invests in Keno he selected some number. If the numbers selected by him and match any of the following levels, he will get the commission bonus on the invested amount')"><i
                                               class="las la-question-circle"></i></span></h5>
                                    <div class="card-body">
                                        <div class="winLevels">
                                            @foreach ($game->level->levels as $item)
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text justify-content-center">@lang('Match')
                                                        {{ getAmount($item->level) }} @lang('number get')</span>
                                                    <input name="level[]" type="hidden" value="{{ getAmount($item->level) }}" required>
                                                    <input class="form-control col-10" name="percent[]" type="number" value="{{ getAmount($item->percent) }}" placeholder="@lang('Commission Percentage')">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border--primary mt-3">
                            <h5 class="card-header bg--primary">@lang('Game Instruction')</h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea class="form-control border-radius-5 nicEdit" name="instruction" rows="8">@php echo $game->instruction @endphp</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card border--primary mt-3">
                                <h5 class="card-header bg--primary">@lang('For App')</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>@lang('Trending')</label>
                                                <input name="trending" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Yes')" data-off="@lang('No')" type="checkbox" @checked($game->trending)>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>@lang('Featured')</label>
                                                <input name="featured" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Yes')" data-off="@lang('No')" type="checkbox" @checked($game->featured)>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.game.index') }}" />
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";


            $('[name=max_select_number]').on('focusout', function(e) {
                let numberOfLevel = $(this).val();
                generrateLevels(numberOfLevel)
            });

            function generrateLevels(numberOfLevel = 10) {
                let minimumLevel = 4;
                if (numberOfLevel < minimumLevel) {
                    notify('error', 'Wining bonus more than 4 level');
                    return;
                }
                if (numberOfLevel > 80) {
                    notify('error', 'Wining bonus less than 80 level');
                    return;
                }
                let html = '';
                if (numberOfLevel && numberOfLevel > 0) {
                    for (let i = minimumLevel; i <= numberOfLevel; i++) {
                        html += `<div class="input-group mb-3">
                                    <span class="input-group-text justify-content-center">@lang('Match') ${i} @lang('number get')</span>
                                    <input type="hidden" name="level[]" value="${i}" required>
                                    <input name="percent[]" class="form-control col-10" type="number" placeholder="@lang('Commission Percentage')">
                                    <span class="input-group-text">%</span>
                                </div>`
                    }
                    $('.winLevels').html(html);
                }
            }
        })(jQuery)
    </script>
@endpush
