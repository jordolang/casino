@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-lg-6">
            <div class="headtail-body">
                @include($activeTemplate . 'partials.game_shape')
                <div class="headtail-body__flip">
                    <div class="spin-card">
                        <div class="wheel-wrapper">
                            <div class="arrow text-center">
                                <img src="{{ asset($activeTemplateTrue . 'images/play/down.png') }}" height="50" width="50">
                            </div>
                            <div class="wheel the_wheel text-center">
                                <canvas class="w-100" id="canvas" width="434" height="434">
                                    <p class="text-white" align="center">@lang("Sorry, your browser doesn't support canvas. Please try another.")</p>
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="headtail-wrapper">
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text bal">{{ showAmount(auth()->user()->balance,currencyFormat:false) }}</span> {{ __(gs('cur_text')) }}</h4>
                <form id="game" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">{{ gs('cur_sym') }}</span>
                            <input type="number" step="any" class="form-control form--control" placeholder="@lang('Enter amount')" name="invest" value="{{ old('invest') }}">
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

                    <div class="headtail-slect">
                        <div class="headtail-slect__box game-select-box black gmimg">
                            <div class="headtail-slect__image">
                                <img src="{{ asset($activeTemplateTrue . 'images/play/moneyblack.png') }}" alt="game-image">
                            </div>
                        </div>
                        <div class="headtail-slect__box game-select-box red gmimg">
                            <div class="headtail-slect__image">
                                <img src="{{ asset($activeTemplateTrue . 'images/play/money.png') }}" alt="game-image">
                            </div>
                        </div>
                        <input name="choose" type="hidden">
                    </div>

                    <div class="form-submit game-playbtn">
                        <button type="submit" class="btn btn--gradient w-100">@lang('Play Now')</button>
                    </div>
                    <button type="button" class="d-block text-white text-center mx-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                        <i class="fas fa-info-circle mr-2"></i> @lang('Game Instruction')
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
    <style type="text/css">
        .the_wheel {
            max-width: 300px !important;
        }

        @media screen and (max-width:1399px) {
            .the_wheel {
                max-width: 250px !important;
            }
        }

        @media screen and (max-width:1199px) {
            .the_wheel {
                max-width: 180px !important;
            }
        }

        @media screen and (max-width:991px) {
            .the_wheel {
                max-width: 230px !important;
            }
        }

        @media screen and (max-width:574px) {
            .the_wheel {
                max-width: 150px !important;
            }
        }

        @media screen and (max-width:375px) {
            .the_wheel {
                max-width: 120px !important;
            }
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/game/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/game/Winwheel.js') }}"></script>
    <script src="{{ asset('assets/global/js/game/spinFunctions.js') }}"></script>
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
            audio = new Audio(`{{ asset('assets/audio/spin-wheel.mp3') }}`);
            audio.play()
            beforeProcess();
            var data = $(this).serialize();
            var url = "{{ route('user.play.game.invest', 'spin_wheel') }}";
            game(url, data);
        });

        function endGame(data) {
            var url = "{{ route('user.play.game.end', 'spin_wheel') }}";
            audio.pause()
            complete(data, url)
        }

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
