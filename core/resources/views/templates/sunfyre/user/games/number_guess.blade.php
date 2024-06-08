@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $gesBon = App\Models\GuessBonus::where('alias', $game->alias)->get();
    @endphp
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-lg-6">
            <div class="headtail-body">
                @include($activeTemplate . 'partials.game_shape')
                <div class="headtail-body__flip">
                    <div class="game-details-left number--guess">
                        <div class="game-details-left__body d-flex align-items-center">
                            <img class="vert-move-down vert down d-none" src="{{ asset($activeTemplateTrue . 'images/play/Down-arrow.png') }}" height="70" width="70" />
                            <img class="vert-move-up vert up d-none" src="{{ asset($activeTemplateTrue . 'images/play/up-arrow.png') }}" height="70" width="70" />
                            <div class="text">
                                <h2 class="custom-font base--color text-center">@lang('You Will Get') {{ $gesBon->count() }} @lang('Chances Per Invest')</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="headtail-wrapper game-contet__sm">
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text bal">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}</h4>
                <form id="game" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group amf">
                            <span class="input-group-text">{{ gs('cur_sym') }}</span>
                            <input type="number" step="any" class="form-control form--control" placeholder="@lang('Enter amount')" name="invest" value="{{ old('invest') }}">
                            <button type="button" class="input-group-text minmax-btn minBtn">@lang('Min')</button>
                            <button type="button" class="input-group-text minmax-btn maxBtn">@lang('Max')</button>
                        </div>

                        <small class="fw-light mt-3 d-inline-block input-inner-note"><i class="fas fa-info-circle mr-2"></i> @lang('Minimum')
                            : {{ showAmount($game->min_limit) }}
                            | @lang('Maximum')
                            : {{ showAmount($game->max_limit) }} | <span class="text--warning">@lang('Win Bonus For This Chance') <span class="bon">{{ __(@$gesBon->first()->percent) }}%</span>
                        </small>
                    </div>

                    <div class="invBtn">
                        <div class="form-submit game-playbtn">
                            <button type="submit" class="btn btn--gradient w-100 my-submit-btn">@lang('Start Game')</button>
                        </div>

                        <button type="button" class="d-block text-white text-center mx-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            <i class="fas fa-info-circle mr-2"></i>
                            @lang('Game Instruction')
                        </button>
                    </div>

                </form>

                <form class="startGame" id="start">
                    @csrf
                    <input name="game_id" type="hidden">
                    <div class="numberGs numHide">
                        <div class="form-group">
                            <input class="form--control guess" name="number" type="number" placeholder="@lang('Guess The Number')" autocomplete="off">
                        </div>
                        <div class="form-submit game-playbtn">
                            <button class="btn btn--gradient gmg w-100" type="submit">@lang('Guess The Number')</button>
                        </div>
                    </div>
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
    <link href="{{ asset('assets/global/css/game/guess.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/game/guess.js') }}"></script>
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

        function color() {
            var myArray = [
                "#0060651a",
                "#654f001a",
                "#6500001a",
                "#5f00651a",
                "#000c651a",
                "#0057651a",
            ];

            var randomItem = myArray[Math.floor(Math.random() * myArray.length)];
            return randomItem;
        }

        function myFunc() {
            $('.game-details-left__body').css('background', color());
        }

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
            playAudio('click.mp3')
            var data = $(this).serialize();
            var url = "{{ route('user.play.game.invest', 'number_guess') }}";
            game(data, url);
        });

        $('#start').on('submit', function(e) {
            e.preventDefault();
            playAudio('click.mp3')
            var data = $(this).serialize();
            var url = "{{ route('user.play.game.end', 'number_guess') }}";
            var bon = {{ @$gesBon->first()->percent }}
            start(url, data, bon);
        });

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
