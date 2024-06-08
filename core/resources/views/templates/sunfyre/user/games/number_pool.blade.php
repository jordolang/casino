@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-lg-6">
            <div class="headtail-body">
                {{-- @include($activeTemplate . 'partials.gane_shapeTwo') --}}
                <div class="game--card pool--card">
                    <div class="game-details-left fly">
                        <div class="game-details-left__body">
                            <div class="alt"></div>
                            <div id="slot-view">
                                <div id="ball-1">
                                    <div class="poolNumber">1</div>
                                </div>
                                <div id="ball-2">
                                    <div class="poolNumber">2</div>
                                </div>
                                <div id="ball-3">
                                    <div class="poolNumber">3</div>
                                </div>
                                <div id="ball-4">
                                    <div class="poolNumber">4</div>
                                </div>
                                <div id="ball-5">
                                    <div class="poolNumber">5</div>
                                </div>
                                <div id="ball-6">
                                    <div class="poolNumber">6</div>
                                </div>
                                <div id="ball-7">
                                    <div class="poolNumber">7</div>
                                </div>
                                <div id="ball-8">
                                    <div class="poolNumber">8</div>
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

                    <div class="poolselect-wrapper">
                        <div class="poolselect-box game-select-box ">
                            <div class="poolselect-box__image pool pool-01">
                                <img class="gmimg pool-01" src="{{ asset($activeTemplateTrue . 'images/games/pool1.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box ">
                            <div class="poolselect-box__image pool pool-02">
                                <img class="gmimg pool-02" src="{{ asset($activeTemplateTrue . 'images/games/pool2.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box">
                            <div class="poolselect-box__image pool pool-03">
                                <img class="gmimg pool-03" src="{{ asset($activeTemplateTrue . 'images/games/pool3.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box  ">
                            <div class="poolselect-box__image pool pool-04">
                                <img class="gmimg pool-04" src="{{ asset($activeTemplateTrue . 'images/games/pool4.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box">
                            <div class="poolselect-box__image pool pool-05">
                                <img class="gmimg pool-05" src="{{ asset($activeTemplateTrue . 'images/games/pool5.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box">
                            <div class="poolselect-box__image pool pool-05">
                                <img class="gmimg pool-05" src="{{ asset($activeTemplateTrue . 'images/games/pool6.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box">
                            <div class="poolselect-box__image pool pool-07">
                                <img class="gmimg pool-07" src="{{ asset($activeTemplateTrue . 'images/games/pool7.png') }}" alt="@lang('image')">
                            </div>
                        </div>
                        <div class="poolselect-box game-select-box">
                            <div class="poolselect-box__image pool pool-08">
                                <img class="gmimg pool-08" src="{{ asset($activeTemplateTrue . 'images/games/pool8.png') }}" alt="@lang('image')">
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
        @media(max-width: 1400px) {
            .headtail-body__shape {
                display: none;
            }

            .headtail-body__flip {
                position: static;
                height: auto;
                width: auto;
                transform: translate(0, 0);
                background-color: hsl(var(--black));
                border-radius: 12px;
                border: 1px solid hsl(var(--white) / .1);
                border-top: 5px solid hsl(var(--base));
            }
        }

        .fly {
            height: 554px;
        }

        .pool--card {
            overflow: hidden;
            position: relative;
        }

        .game-details-left {
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            border-radius: 8px;
            min-height: 100%;
            position: relative;
            width: 100%;
        }
    </style>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/global/css/game/pool.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('assets/global/js/game/pool.js') }}"></script>
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
                notify('error', 'Pool selection is required')
                return;
            }

            audio = new Audio(`{{ asset('assets/audio/pool.mp3') }}`)
            audio.play();
            $('button[type=submit]').html('<i class="la la-gear fa-spin"></i> Processing...');
            $('button[type=submit]').attr('disabled', '');
            $('.cd-ft').html('');
            var data = $(this).serialize();
            var url = "{{ route('user.play.game.invest', 'number_pool') }}"
            $('#slot-view').removeClass('finish');
            game(data, url);
        });

        function endGame(data) {
            var url = "{{ route('user.play.game.end', 'number_pool') }}";
            audio.pause()
            complete(data, url);
        }

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
