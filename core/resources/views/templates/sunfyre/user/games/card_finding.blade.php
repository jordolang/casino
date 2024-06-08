@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-lg-6">
            <div class="card custom--card game--card">
                <div class="card-body p-0">
                    <div class="game-details-left overflow-hidden">
                        <div class="fly">
                            <div class="d-none" id="cards"></div>
                            <div class="flying text-center">
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/01.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/34.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/20.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/29.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/09.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/53.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/2.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/52.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/36.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/25.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/40.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/30.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/19.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/53.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/13.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/51.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/16.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/50.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/08.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/47.png') }}">
                                    </div>
                                </div>
                                <div class="card-holder">
                                    <div class="back"></div>
                                    <div class="flying-card clubs">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/24.png') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-none res res-thumb-img t--60px m-0">
                                <div class="res--card--img">
                                    <div class="back"></div>
                                    <div class="flying-card clubs resImg">
                                        <img class="w-100" src="{{ asset($activeTemplateTrue . 'images/play/cards/24.png') }}">
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
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text bal">{{ showAmount(auth()->user()->balance, currencyFormat: false) }} </span> {{ __(gs('cur_text')) }}</h4>
                <form id="game" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">{{ gs('cur_sym') }}</span>
                            <input type="number" step="any" class="form-control form--control" placeholder="@lang('Enter amount')" name="invest" value="{{ old('invest') }}">
                            <button type="button" class="input-group-text minmax-btn minBtn">@lang('Min')</button>
                            <button type="button" class="input-group-text minmax-btn maxBtn">@lang('Max')</button>
                        </div>
                        <small class="fw-light mt-3 d-inline-block input-inner-note">
                            <i class="fas fa-info-circle mr-2"></i> @lang('Minimum')
                            : {{ showAmount($game->min_limit) }} | @lang('Maximum')
                            : {{ showAmount($game->max_limit) }} | <span class="text--warning">@lang('Win Amount') @if ($game->invest_back == 1)
                                    {{ getAmount($game->win + 100) }}
                                @else
                                    {{ getAmount($game->win) }}
                                @endif %</span>
                        </small>
                    </div>

                    <div class="headtail-slect">
                        <div class="headtail-slect__box game-select-box red">
                            <div class="card-box-image">
                                <img class="red" src="{{ asset($activeTemplateTrue . 'images/play/cards/27.png') }}" alt="">
                            </div>
                        </div>
                        <div class="headtail-slect__box game-select-box black">
                            <div class="card-box-image">
                                <img class="black" src="{{ asset($activeTemplateTrue . 'images/play/cards/40.png') }}" alt="">
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

@push('style-lib')
    <link href="{{ asset('assets/global/css/game/deck.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/game/card.css') }}" rel="stylesheet">
@endpush


@push('script-lib')
    <script src="{{ asset('assets/global/js/game/deck.js') }}"></script>
    <script src="{{ asset('assets/global/js/game/deckinit.js') }}"></script>
    <script src="{{ asset('assets/global/js/game/cardgame.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        let timerA;
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
                notify('error', 'Card selection is required')
                return;
            }

            audio = new Audio(`{{ asset('assets/audio/card.mp3') }}`)
            audio.play();
            beforeProcess();
            var data = $(this).serialize();
            var url = '{{ route('user.play.game.invest', 'card_finding') }}';
            game(data, url);
        });


        function startGame(data) {
            animationCard(data);
            $('button[type=submit]').html('<i class="la la-gear fa-spin"></i> Playing...');
            timerA = setInterval(function() {
                succOrError();
                endGame(data);
            }, 10110);
            $('button[type=submit]').html('<i class="la la-gear fa-spin"></i> Playing...');
        }

        function animationCard(data) {
            $('.flying').addClass('d-none');
            $('#cards').removeClass('d-none');
            deck.sort()
            deck.sort()
            deck.sort()
            deck.sort()
            deck.sort()
            deck.sort()
            deck.fan()
            var img = `{{ asset($activeTemplateTrue . 'images/play/cards/') }}/${card(data.result)}.png`;
            setTimeout(function() {
                $('.resImg').find('img').attr('src', img)
                $('#cards').addClass('op');
                $('.res').removeClass('d-none');
            }, 10110);
        }


        function success(data) {
            $('.win-loss-popup').addClass('active');
            $('.win-loss-popup__body').find('img').addClass('d-none');
            if (data.type == 'success') {
                playAudio('win.wav')
                $('.win-loss-popup__body').find('.win').removeClass('d-none');
            } else {
                playAudio('lose.wav')
                $('.win-loss-popup__body').find('.lose').removeClass('d-none');
            }
            $('.win-loss-popup__footer').find('.data-result').text(data.result);


            var bal = parseFloat(data.bal);
            $('.bal').html(bal.toFixed(2));
            $('button[type=submit]').html('Play');
            $('button[type=submit]').removeAttr('disabled');
            $('.single-select').removeClass('active');
            $('.single-select').removeClass('op');
            $('.single-select').find('img').removeClass('op');
            $('img').removeClass('op');
        }

        function endGame(data) {
            var url = "{{ route('user.play.game.end', 'card_finding') }}";
            audio.pause();
            complete(data, url);
        }

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
