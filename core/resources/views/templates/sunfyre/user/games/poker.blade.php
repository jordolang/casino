@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $gesBon = App\Models\GuessBonus::where('alias', $game->alias)
            ->orderBy('chance', 'asc')
            ->pluck('percent')
            ->toArray();
    @endphp

    <div class="row gy-4">
        <div class="col-xl-9" id="game--card">
            <div class="game--card">
                <div class="row align-items-center gy-4">
                    <div class="col-md-3">
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/royal_flush.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[0]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/straight_flush.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[1]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/four_kind.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[2]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/full_house.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[3]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/flash.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[4]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/straight.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[5]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/three_kind.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[6]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/two_pair.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[7]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/one_pair.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[8]) }}@lang('%')
                            </div>
                        </div>
                        <div class="card-item">
                            <div class="card-item__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'images/poker/high_card.png') }}" alt="@lang('image')">
                            </div>
                            <div class="card-item__text">
                                <span class="card-item__icon"> <i class="las la-times"></i></span>
                                {{ getAmount(@$gesBon[9]) }}@lang('%')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="poker-card-table">
                            <div class="poker-table">
                                <div class="poker-table__wrapper">
                                    <div class="poker-table__thumb">
                                        <img src="{{ asset($activeTemplateTrue . 'images/cards/BACK.png') }}" alt="@lang('image')">
                                    </div>
                                    <div class="poker-table__thumb">
                                        <img src="{{ asset($activeTemplateTrue . 'images/cards/BACK.png') }}" alt="@lang('image')">
                                    </div>
                                    <div class="poker-table__thumb">
                                        <img src="{{ asset($activeTemplateTrue . 'images/cards/BACK.png') }}" alt="@lang('image')">
                                    </div>
                                    <div class="poker-table__thumb">
                                        <img src="{{ asset($activeTemplateTrue . 'images/cards/BACK.png') }}" alt="@lang('image')">
                                    </div>
                                    <div class="poker-table__thumb">
                                        <img src="{{ asset($activeTemplateTrue . 'images/cards/BACK.png') }}" alt="@lang('image')">
                                    </div>
                                </div>
                            </div>
                            <div class="poker-card__bottom refresh-area">
                                <div class="form-submit game-playbtn">
                                    <button class="btn btn--gradient refreshBtn" type="button">
                                        @lang('Refresh')
                                    </button>
                                </div>
                            </div>

                            <div class="poker-card__bottom deal-area">
                                <div class="form-submit game-playbtn">
                                    <button class="btn btn--gradient dealBtn" type="button">
                                        @lang('DEAL')
                                    </button>
                                </div>
                            </div>

                            <div class="poker-card__bottom action-area">
                                <div class="form-submit game-playbtn">
                                    <button class="btn btn--gradient callBtn" type="button">
                                        @lang('CALL')
                                    </button>
                                    <button class="btn btn--gradient foldBtn" type="button">
                                        @lang('FOLD')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3" id="form--area">
            <div class="game--card">
                <h4 class="game-contet-title">@lang('Current Balance'):
                    <span class="text balance">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}
                </h4>
                <form id="game" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control form--control" name="invest" type="number" step="any" value="{{ old('invest') }}" placeholder="@lang('Enter amount')" autocomplete="off">
                            <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                        </div>
                        <small class="fw-light mt-3 d-inline-block input-inner-note">
                            <i class="fas fa-info-circle mr-2"></i> @lang('Invest Limit')
                            : {{ showAmount($game->min_limit) }} -
                            {{ showAmount($game->max_limit) }}
                        </small>
                    </div>
                    <div class="form-submit game-playbtn">
                        <button type="submit" class="btn btn--gradient w-100">@lang('Play Now')</button>
                    </div>
                    <button type="button" class="d-block text-white text-center mx-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i
                           class="fas fa-info-circle mr-2"></i>
                        @lang('Game Instruction')
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal custom--modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content section--bg">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('Game Rule')</h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    @php echo $game->instruction @endphp
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .card-item::before {
            background-image: unset;
        }

        .card-item::after {
            background-image: unset;
        }

        .card-item {
            border: none;
        }

        .btn--gradient.callBtn,
        .btn--gradient.foldBtn,
        .btn--gradient.dealBtn,
        .btn--gradient.refreshBtn {
            padding: 12px 20px !important;
            font-size: 20px !important;
            border-radius: 8px;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/global/js/game/poker.js') }}"></script>

    <script>
        "use strict";
        (function($) {

            let userBalance = Number("{{ auth()->user()->balance }}");
            let minLimit = Number("{{ $game->min_limit }}");
            let maxLimit = Number("{{ $game->max_limit }}");
            let currency = "{{ gs('cur_text') }}";
            let audio;

            $('#game').on('submit', function(e) {
                e.preventDefault();
                invest = investField.val();
                if (!invest) {
                    notify('error', 'Invest field is required');
                    return;
                }
                if (minLimit > invest) {
                    notify('error', `Minimum invest is ${minLimit} ${currency}`);
                    return;
                }
                if (invest > maxLimit) {
                    notify('error', `Maximum invest is ${maxLimit} ${currency}`);
                    return;
                }
                if (invest > userBalance) {
                    notify('error', 'You have no sufficent balance');
                    return;
                }

                let previousId = localStorage.getItem("sessionId");
                if (previousId) {
                    notify('error', 'Please refresh the card');
                    return;
                }

                investBtn.addClass("d-none")

                let investUrl = "{{ route('user.play.game.invest', $game->alias) }}";
                let data = {
                    _token: "{{ csrf_token() }}",
                    invest: invest
                };
                game(investUrl, data)
            });
            $('.dealBtn').on('click', function(e) {
                audio = new Audio(`{{ asset('assets/audio/click.mp3') }}`);
                audio.play()
                if (!gameLogId) {
                    notify('error', 'Invalid request');
                }
                let dealUrl = "{{ route('user.play.game.poker.deal') }}";
                let dealData = {
                    _token: "{{ csrf_token() }}",
                    game_id: gameLogId
                }
                deal(dealUrl, dealData);
            });
            $('.callBtn').on('click', function(e) {
                audio = new Audio(`{{ asset('assets/audio/click.mp3') }}`);
                audio.play()
                if (!gameLogId) {
                    notify('error', 'Invalid request');
                }

                $(this).prop('disabled', true);

                let callUrl = "{{ route('user.play.game.poker.call') }}";
                let callData = {
                    _token: "{{ csrf_token() }}",
                    game_id: gameLogId
                }
                call(callUrl, callData);
            });
            $('.foldBtn').on('click', function(e) {
                audio = new Audio(`{{ asset('assets/audio/click.mp3') }}`);
                audio.play()

                if (!gameLogId) {
                    notify('error', 'Invalid request');
                }

                $(this).prop('disabled', true);

                let foldUrl = "{{ route('user.play.game.poker.fold') }}";
                let foldData = {
                    _token: "{{ csrf_token() }}",
                    game_id: gameLogId
                }
                fold(foldUrl, foldData);
            });
        })(jQuery)
    </script>
@endpush
