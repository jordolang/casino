@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5">
        <div class="col-lg-6">
            <div class="headtail-body">
                @include($activeTemplate . 'partials.game_shape')
                <div class="headtail-body__flip">
                    <div class="coin-flipbox">
                        <div class="flp">
                            <div id="coin-flip-cont">
                                <div class="flipcoin" id="coin">
                                    <div class="flpng coins-wrapper">
                                        <div class="front"><img src="{{ asset($activeTemplateTrue . 'images/games/head.png') }}" alt="im"></div>
                                        <div class="back"><img src="{{ asset($activeTemplateTrue . 'images/games/tail.png') }}" alt="im"></div>
                                    </div>
                                    <div class="headCoin d-none">
                                        <div class="front"><img src="{{ asset($activeTemplateTrue . 'images/games/head.png') }}" alt="im"></div>
                                        <div class="back"><img src="{{ asset($activeTemplateTrue . 'images/games/tail.png') }}" alt="im"></div>
                                    </div>
                                    <div class="tailCoin d-none">
                                        <div class="front"><img src="{{ asset($activeTemplateTrue . 'images/games/tail.png') }}" alt="im"></div>
                                        <div class="back"><img src="{{ asset($activeTemplateTrue . 'images/games/head.png') }}" alt="im"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="headtail-wrapper">
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text bal">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}</h4>
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
                            : {{ showAmount($game->min_limit) }}| @lang('Maximum')
                            : {{ showAmount($game->max_limit) }}|
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
                        <div class="headtail-slect__box game-select-box">
                            <div class="headtail-slect__image single-select head gmimg">
                                <img src="{{ asset($activeTemplateTrue . '/images/games/head.png') }}" alt="game-image">
                            </div>
                        </div>
                        <div class="headtail-slect__box game-select-box">
                            <div class="headtail-slect__image single-select tail gmimg">
                                <img src="{{ asset($activeTemplateTrue . '/images/games/tail.png') }}" alt="game-image">
                            </div>
                        </div>
                        <input name="choose" type="hidden">
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
    <link href="{{ asset('assets/global/css/game/coinflipping.min.css') }}" rel="stylesheet">
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/game/coin.js') }}"></script>
@endpush

@push('style')
    <style>
        #coin,
        .coins-wrapper,
        #coin .front,
        #coin .back,
        #coin-flip-cont,
        .flp {
            width: 200px;
            height: 200px;
        }

        @media(max-width: 991px) {

            #coin,
            .coins-wrapper,
            #coin .front,
            #coin .back,
            #coin-flip-cont,
            .flp {
                width: 300px;
                height: 300px;
            }
        }


        @media(max-width: 767px) {

            #coin,
            .coins-wrapper,
            #coin .front,
            #coin .back,
            #coin-flip-cont,
            .flp {
                width: 200px !important;
                height: 200px !important;
            }

            .headtail-body .coin-flipbox {
                width: 200px;
                height: 200px;
            }
        }

        @media(max-width: 425px) {

            #coin,
            .coins-wrapper,
            #coin .front,
            #coin .back,
            #coin-flip-cont,
            .flp {
                width: 120px !important;
                height: 120px !important;
            }

            .headtail-body .coin-flipbox {
                width: 120px;
                height: 120px;
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


        $('#game').on('submit', function(e) {
            e.preventDefault();
            if (!$('[name=invest]').val()) {
                notify('error', 'Invest amount is required')
                return;
            }

            if (!$('[name=choose]').val()) {
                notify('error', 'Coin selection is required')
                return;
            }

            audio = new Audio(`{{ asset('assets/audio/coin.mp3') }}`);
            audio.play()
            $('.flipcoin').removeClass('animateClick');
            $('.flpng').removeClass('d-none');
            $('#coin .headCoin').addClass('d-none');
            $('#coin .tailCoin').addClass('d-none');
            $('.cmn-btn').html('<i class="la la-gear fa-spin"></i> Processing...');
            $('.cmn-btn').attr('disabled', true);
            var data = $(this).serialize();
            var url = "{{ route('user.play.game.invest', 'head_tail') }}";
            game(data, url);
        });

        function endGame(data) {
            var url = "{{ route('user.play.game.end', 'head_tail') }}";
            audio.pause()
            complete(data, url);
        }

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
