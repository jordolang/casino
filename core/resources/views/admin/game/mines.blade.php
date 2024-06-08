@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-30">
        <div class="col-lg-6">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang('Current Setting')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Number of Mines')</th>
                                    <th>@lang('Commision')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bonuses ??[] as $bonus)
                                    <tr>
                                        <td>@lang('MINES#') {{ $bonus->chance }}</td>
                                        <td>{{ getAmount($bonus->percent) }} %</td>
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
        <div class="col-lg-6">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang('Change Setting')</h4>
                </div>
                <div class="card-body">

                    <div class="form-group mb-0">
                        <label>@lang('Number of Mines')</label>
                        <div class="input-group">
                            <input type="number" name="level" min="1" placeholder="@lang('Type a number & hit ENTER ↵')"
                                   class="form-control">
                            <button type="button" class="btn btn--primary generate">@lang('Generate')</button>
                        </div>
                        <span class="text--danger required-message d-none">@lang('Please enter a number')</span>
                    </div>
                    <form action="{{ route('admin.game.chance.create', 'mines') }}" method="post" class="d-none levelForm">
                        @csrf
                        <h6 class="text--danger my-3">@lang('Mines & Bonus old data will remove after generate')</h6>
                        <div class="form-group">
                            <div class="chanceLevels"></div>
                        </div>
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.game.update', $game->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader image="{{ $game->image }}" class="w-100" type="game" :required=false />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>@lang('Game Name')</label>
                                    <input class="form-control" name="name" type="text" value="{{ $game->name }}"
                                           placeholder="@lang('Game Name')" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary">@lang('Play Amount')</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>@lang('Minimum Invest Amount')</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control" name="min" type="number" value="{{ getAmount($game->min_limit) }}" step="any" min="1" placeholder="@lang('Minimum Invest Amount')" required>
                                                        <span class="input-group-text">{{ gs('cur_text') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>@lang('Maximum Invest Amount')</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control" name="max" type="number" value="{{ getAmount($game->max_limit) }}" step="any" min="1" placeholder="@lang('Maximum Invest Amount')" required>
                                                        <span class="input-group-text">{{ gs('cur_text') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary">@lang('Win Setting') </h5>
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label>@lang('Win Chance')</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control" name="probable" type="number" value="{{ getAmount($game->probable_win) }}">
                                                        <span class="input-group-text">@lang('%')</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card border--primary mt-3">
                                <h5 class="card-header bg--primary">@lang(' Game Instruction')</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea class="form-control border-radius-5 nicEdit" name="instruction" rows="8">@php echo $game->instruction @endphp</textarea>
                                    </div>
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
                        <div class="mt-3">
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
            $('[name="level"]').on('keyup', function(e) {
                if (e.which == 13) {
                    generrateLevels($(this));
                }
            });

            $(".generate").on('click', function() {
                let $this = $(this).parents('.card-body').find('[name="level"]');
                generrateLevels($this);
            });

            $(document).on('click', '.deleteBtn', function() {
                $(this).closest('.input-group').remove();
            });

            function generrateLevels($this) {
                let numberOfLevel = $this.val();
                if (numberOfLevel != 20) {
                    notify('error', 'Maximum mines count will be 20')
                    return;
                }
                let parent = $this.parents('.card-body');
                let html = '';
                if (numberOfLevel && numberOfLevel > 0) {
                    parent.find('.levelForm').removeClass('d-none');
                    parent.find('.required-message').addClass('d-none');

                    for (i = 1; i <= numberOfLevel; i++) {
                        html += `
                    <div class="input-group mb-3">
                        <span class="input-group-text justify-content-center">@lang('Mines') ${i}</span>
                        <input type="hidden" name="chance[]" value="${i}" required>
                        <input name="percent[]" class="form-control col-10" type="number" required placeholder="@lang('Commission Percentage')">
                        <button class="btn btn--danger input-group-text deleteBtn" type="button"><i class=\'la la-times\'></i></button>
                    </div>`
                    }

                    parent.find('.chanceLevels').html(html);
                } else {
                    parent.find('.levelForm').addClass('d-none');
                    parent.find('.required-message').removeClass('d-none');
                }
            }

        })(jQuery)
    </script>
@endpush
