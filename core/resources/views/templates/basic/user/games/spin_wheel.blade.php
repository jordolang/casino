@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body h-100 middle-el">
                        <div class="cd-ft"></div>
                        <div class="game-details-left">
                            <div class="game-details-left__body">
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
                </div>
                <div class="col-lg-6 mt-lg-0 mt-5">
                    <div class="game-details-right">
                        <form id="game" method="post">
                            @csrf
                            <h3 class="f-size--28 mb-4 text-center">@lang('Current Balance') : <span class="base--color"><span class="bal">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}</span>
                            </h3>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input class="form-control amount-field" name="invest" type="text" placeholder="Enter amount" autocomplete="off" required>
                                    <span class="input-group-text" id="basic-addon2">{{ __(gs('cur_text')) }}</span>
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-2"></i> @lang('Minimum :') {{ showAmount($game->min_limit + 0) }}
                                    | @lang('Maximum :') {{ showAmount($game->max_limit + 0) }}
                                    | <span class="text--warning"> @lang('Win Amount') @if ($game->invest_back == 1)
                                            {{ getAmount($game->win + 100) }}
                                        @else
                                            {{ getAmount($game->win) }}
                                        @endif @lang('%') </span></small>
                            </div>
                            <div class="form-group justify-content-center d-flex mt-5">
                                <div class="single-select black gmimg">
                                    <img src="{{ asset($activeTemplateTrue . 'images/play/moneyblack.png') }}" alt="game-image">
                                </div>
                                <div class="single-select red gmimg">
                                    <img src="{{ asset($activeTemplateTrue . 'images/play/money.png') }}" alt="game-image">
                                </div>
                            </div>
                            <input name="choose" type="hidden">
                            <div class="mt-5 text-center">
                                <button class="cmn-btn w-100 text-center" type="submit">@lang('Play Now')</button>
                                <a class="game-instruction mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">@lang('Game Instruction')
                                    <i class="las la-info-circle"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content section--bg">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('Game Rule')</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
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
            max-width: 450px;
        }

        @media (max-width: 425px) {
            .game-details-left {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                padding: 20px;
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
        let audio;
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
