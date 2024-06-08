@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-xl-6 col-lg-7">
            <div class="headtail-body">
                @include($activeTemplate . 'partials.game_shape')
                <div class="headtail-body__flip middle-el">
                    <div class="cd-ft"></div>
                    <div class="game-details-left">
                        <div class="game-details-left__body">
                            <div class="roll">
                                <div id="wrapper">
                                    <div id="platform">
                                        <div class="diceRolling" id="dice">
                                            <div class="side front">
                                                <div class="dot center"></div>
                                            </div>
                                            <div class="side front inner"></div>
                                            <div class="side top">
                                                <div class="dot dtop dleft"></div>
                                                <div class="dot dbottom dright"></div>
                                            </div>
                                            <div class="side top inner"></div>
                                            <div class="side right">
                                                <div class="dot dtop dleft"></div>
                                                <div class="dot center"></div>
                                                <div class="dot dbottom dright"></div>
                                            </div>
                                            <div class="side right inner"></div>
                                            <div class="side left">
                                                <div class="dot dtop dleft"></div>
                                                <div class="dot dtop dright"></div>
                                                <div class="dot dbottom dleft"></div>
                                                <div class="dot dbottom dright"></div>
                                            </div>
                                            <div class="side left inner"></div>
                                            <div class="side bottom">
                                                <div class="dot center"></div>
                                                <div class="dot dtop dleft"></div>
                                                <div class="dot dtop dright"></div>
                                                <div class="dot dbottom dleft"></div>
                                                <div class="dot dbottom dright"></div>
                                            </div>
                                            <div class="side bottom inner"></div>
                                            <div class="side back">
                                                <div class="dot dtop dleft"></div>
                                                <div class="dot dtop dright"></div>
                                                <div class="dot dbottom dleft"></div>
                                                <div class="dot dbottom dright"></div>
                                                <div class="dot center dleft"></div>
                                                <div class="dot center dright"></div>
                                            </div>
                                            <div class="side back inner"></div>
                                            <div class="side cover x"></div>
                                            <div class="side cover y"></div>
                                            <div class="side cover z"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5">
            <div class="headtail-wrapper">
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text bal">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}</h4>
                <form id="game" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">{{ gs('cur_sym') }}</span>
                            <input type="number" step="any" class="form-control form--control" name="invest" placeholder="@lang('Enter amount')" value="{{ old('invest') }}">
                            <button type="button" class="input-group-text minmax-btn minBtn">@lang('Min')</button>
                            <button type="button" class="input-group-text minmax-btn maxBtn">@lang('Max')</button>
                        </div>
                        <small class="fw-light mt-3 d-inline-block input-inner-note"><i
                               class="fas fa-info-circle mr-2"></i>
                            @lang('Minimum')
                            : {{ showAmount($game->min_limit) }} | @lang('Maximum')
                            : {{ showAmount($game->max_limit) }} |
                            <span class="text--warning">@lang('Win Amount')
                                @if ($game->invest_back == 1)
                                    {{ getAmount($game->win + 100) }}
                                @else
                                    {{ getAmount($game->win) }}
                                @endif %
                            </span>
                        </small>
                    </div>

                    <div class="diceroll-slect">
                        <div class="diceroll-selct game-select-box dice1">
                            <img class="gmimg dice1" src="{{ asset($activeTemplateTrue . 'images/play/dice1.png') }}" alt="@lang('image')">
                        </div>
                        <div class="diceroll-selct game-select-box dice2">
                            <img class="gmimg dice2" src="{{ asset($activeTemplateTrue . 'images/play/dice2.png') }}" alt="@lang('image')">
                        </div>
                        <div class="diceroll-selct game-select-box dice3">
                            <img class="gmimg dice3" src="{{ asset($activeTemplateTrue . 'images/play/dice3.png') }}" alt="@lang('image')">
                        </div>
                        <div class="diceroll-selct game-select-box dice4">
                            <img class="gmimg dice4" src="{{ asset($activeTemplateTrue . 'images/play/dice4.png') }}" alt="@lang('image')">
                        </div>
                        <div class="diceroll-selct game-select-box dice5">
                            <img class="gmimg dice5" src="{{ asset($activeTemplateTrue . 'images/play/dice5.png') }}" alt="@lang('image')">
                        </div>
                        <div class="diceroll-selct game-select-box dice6">
                            <img class="gmimg dice6" src="{{ asset($activeTemplateTrue . 'images/play/dice6.png') }}" alt="@lang('image')">
                        </div>

                        <input name="choose" type="hidden">
                        <input name="type" type="hidden" value="ht">
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

@push('style-lib')
    <link href="{{ asset('assets/global/css/game/dice.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/game/dice.js') }}"></script>
@endpush

@push('style')
    <style>
        .diceroll-selct img {
            height: 60px;
            width: 60px;
        }

        .game-details-left {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 50px;
            border-radius: 8px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            -ms-border-radius: 8px;
            -o-border-radius: 8px;
            min-height: 100%;
            position: relative;
        }

        .roll {
            height: 200px;
        }


        @media (max-width:575px) {
            .headtail-body {
                height: 500px;
                padding: 50px 30px;
                background-color: hsl(var(--black));
                border: 1px solid hsl(var(--white) / 0.1);
                border-top: 5px solid hsl(var(--base));
                border-radius: 12px;
                top: 0;
            }
        }
    </style>
@endpush


@push('script')
    <script>
        "use strict";
        let investField = $("[name=invest]");
        let minLimit = Number("{{ $game->min_limit }}");
        let maxLimit = Number("{{ $game->max_limit }}");
        let currency = "{{ gs('cur_text') }}";
        let audio;

        $(".minBtn").on('click', function(e) {
            audio = new Audio(`{{ asset('assets/audio/click.mp3') }}`);
            audio.play()
            investField.val(minLimit);
        });

        $(".maxBtn").on('click', function(e) {
            audio = new Audio(`{{ asset('assets/audio/click.mp3') }}`);
            audio.play()
            investField.val(maxLimit);
        });



        $('input[name=invest]').keypress(function(e) {
            var character = String.fromCharCode(e.keyCode)
            var newValue = this.value + character;
            if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
                e.preventDefault();
                return false;
            }
        });

        function hasDecimalPlace(value, x) {
            var pointIndex = value.indexOf('.');
            return pointIndex >= 0 && pointIndex < value.length - x;
        }

        $('#game').on('submit', function(e) {
            e.preventDefault();

            if (!$('[name=invest]').val()) {
                notify('error', 'Invest amount is required')
                return;
            }
            if (!$('[name=choose]').val()) {
                notify('error', 'Spin selection is required')
                return;
            }

            audio = new Audio(`{{ asset('assets/audio/casino-dice.mp3') }}`)
            audio.play()
            $('button[type=submit]').html('<i class="la la-gear fa-spin"></i> Processing...');
            $('button[type=submit]').attr('disabled', '');
            $('.cd-ft').html('');
            var url = "{{ route('user.play.game.invest', 'dice_rolling') }}";
            var data = $(this).serialize();
            game(data, url);
        });

        function endGame(data) {
            var url = "{{ route('user.play.game.end', 'dice_rolling') }}";
            audio.pause()
            complete(data, url)
        }

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
