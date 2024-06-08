@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-lg-6">
            <div class=" game--card">
                <div class=" number-slot-wrapper">
                    <div class="number-slot-box">
                        <div class='machine position-relative'>
                            <div class='slots'>
                                <ul class='slot' id="slot1">
                                    <li class='numbers'>0</li>
                                    <li class='numbers'>1</li>
                                    <li class='numbers'>2</li>
                                    <li class='numbers'>3</li>
                                    <li class='numbers'>4</li>
                                    <li class='numbers'>5</li>
                                    <li class='numbers'>6</li>
                                    <li class='numbers'>7</li>
                                    <li class='numbers'>8</li>
                                    <li class='numbers'>9</li>
                                </ul>
                                <ul class='slot' id="slot2">
                                    <li class='numbers'>0</li>
                                    <li class='numbers'>1</li>
                                    <li class='numbers'>2</li>
                                    <li class='numbers'>3</li>
                                    <li class='numbers'>4</li>
                                    <li class='numbers'>5</li>
                                    <li class='numbers'>6</li>
                                    <li class='numbers'>7</li>
                                    <li class='numbers'>8</li>
                                    <li class='numbers'>9</li>
                                </ul>
                                <ul class='slot' id="slot3">
                                    <li class='numbers'>0</li>
                                    <li class='numbers'>1</li>
                                    <li class='numbers'>2</li>
                                    <li class='numbers'>3</li>
                                    <li class='numbers'>4</li>
                                    <li class='numbers'>5</li>
                                    <li class='numbers'>6</li>
                                    <li class='numbers'>7</li>
                                    <li class='numbers'>8</li>
                                    <li class='numbers'>9</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="headtail-wrapper game-contet__sm">
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
                            : {{ showAmount($game->max_limit) }}</small>
                        <small class="form-text text-muted mb-3">@lang('Win Amount') : <span class="text--warning">@lang('Single') ({{ @$game->level[0] }}%)</span> | <span class="text--warning">@lang('Double') ({{ @$game->level[1] }}%)</span> | <span class="text--warning">@lang('Triple') ({{ @$game->level[2] }}%)</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <input class="form--control choose-number" name="choose" type="number" min="0" max="9" placeholder="@lang('Enter Number')" required>
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
        .number-slot-box .machine {
            width: 100%;
        }

        .choose-number {
            border-radius: 12px;
        }
    </style>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/global/css/game/slot.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/game/slot.js') }}"></script>
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
                notify('error', 'Choose number is required')
                return;
            }

            audio = new Audio(`{{ asset('assets/audio/number-slot.mp3') }}`)
            audio.play();
            $('button[type=submit]').html('<i class="la la-gear fa-spin"></i> Processing...');
            $('button[type=submit]').attr('disabled', '');
            $('.alert').remove();
            var data = $(this).serialize();
            var url = "{{ route('user.play.game.invest', 'number_slot') }}";
            game(data, url);
        });

        function endGame(data) {
            var url = "{{ route('user.play.game.end', 'number_slot') }}";
            audio.pause();
            complete(data, url);
        }

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
