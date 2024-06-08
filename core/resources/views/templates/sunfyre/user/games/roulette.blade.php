@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center game-wrapper">
        <div class="col-lg-6">
            <div class="headtail-body">
                @include($activeTemplate . 'partials.game_shape')
                <div class="headtail-body__flip">
                    <div class="roulette-game-spin">
                        <div class="plate" id="plate">
                            <ul class="inner">
                                <li class="number"><label><input name="pit" type="radio" value="32" /><span class="pit">32</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="15" /><span class="pit">15</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="19" /><span class="pit">19</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="4" /><span class="pit">4</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="21" /><span class="pit">21</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="2" /><span class="pit">2</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="25" /><span class="pit">25</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="17" /><span class="pit">17</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="34" /><span class="pit">34</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="6" /><span class="pit">6</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="27" /><span class="pit">27</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="13" /><span class="pit">13</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="36" /><span class="pit">36</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="11" /><span class="pit">11</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="30" /><span class="pit">30</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="8" /><span class="pit">8</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="23" /><span class="pit">23</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="10" /><span class="pit">10</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="5" /><span class="pit">5</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="24" /><span class="pit">24</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="16" /><span class="pit">16</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="33" /><span class="pit">33</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="1" /><span class="pit">1</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="20" /><span class="pit">20</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="14" /><span class="pit">14</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="31" /><span class="pit">31</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="9" /><span class="pit">9</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="22" /><span class="pit">22</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="18" /><span class="pit">18</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="29" /><span class="pit">29</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="7" /><span class="pit">7</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="28" /><span class="pit">28</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="12" /><span class="pit">12</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="35" /><span class="pit">35</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="3" /><span class="pit">3</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="26" /><span class="pit">26</span></label></li>
                                <li class="number"><label><input name="pit" type="radio" value="0" /><span class="pit">0</span></label></li>
                            </ul>
                            <div class="data">
                                <div class="data-inner">
                                    <div class="mask"></div>
                                    <div class="result">
                                        <div class="result-number">00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="headtail-wrapper game-contet__sm">
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text user-balance">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}</h4>
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
                            <i class="fas fa-info-circle mr-2"></i> @lang('Limit')
                            : {{ showAmount($game->min_limit) }} - {{ showAmount($game->max_limit) }}
                        </small>
                        <small class="win-bonus text--base"></small>
                    </div>
                    <input name="choose" type="hidden">
                    <div class="form-submit game-playbtn">
                        <button type="button" class="btn btn--gradient play-btn w-100">@lang('Play Now')</button>
                    </div>
                    <button type="button" class="d-block text-white text-center mx-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                        <i class="fas fa-info-circle mr-2"></i> @lang('Game Instruction')
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="game--card">
                <div class="all-number d-block roulette-wrapper game-details-right">
                    <table>
                        <tbody>
                            <tr class="numbers">
                                <td class="zero bg-transparent" rowspan="3"> <span class="number-item">0</span></td>
                                <td class="bg-danger redEl oneToTwEl oneToEtEl oddEl"> <span class="number-item">3</span></td>
                                <td class="bg-dark blackEl oneToTwEl oneToEtEl evenEl"> <span class="number-item">6</span></td>
                                <td class="bg-danger redEl oneToTwEl oneToEtEl oddEl"> <span class="number-item">9</span></td>
                                <td class="bg-danger redEl oneToTwEl oneToEtEl evenEl"> <span class="number-item">12</span></td>
                                <td class="bg-dark blackEl thrtToTfEl oneToEtEl oddEl"> <span class="number-item">15</span></td>
                                <td class="bg-danger redEl thrtToTfEl oneToEtEl evenEl"> <span class="number-item">18</span></td>
                                <td class="bg-danger redEl thrtToTfEl nineteenTtsixEl oddEl"> <span class="number-item">21</span></td>
                                <td class="bg-dark blackEl thrtToTfEl nineteenTtsixEl evenEl"> <span class="number-item">24</span></td>
                                <td class="bg-danger redEl twfToTsEl nineteenTtsixEl oddEl"> <span class="number-item">27</span></td>
                                <td class="bg-danger redEl twfToTsEl nineteenTtsixEl evenEl"> <span class="number-item">30</span></td>
                                <td class="bg-dark blackEl twfToTsEl nineteenTtsixEl oddEl"> <span class="number-item">33</span></td>
                                <td class="bg-danger redEl twfToTsEl nineteenTtsixEl evenEl"> <span class="number-item">36</span></td>
                                <td class="twByOne1 p-0">
                                    <button class="btn-color" type="button">2:1</button>
                                    <input type="hidden" value="0">
                                </td>
                            </tr>
                            <tr class="numbers">
                                <td class="bg-dark blackEl oneToTwEl oneToEtEl evenEl"> <span class="number-item">2</span></td>
                                <td class="bg-danger redEl oneToTwEl oneToEtEl oddEl"> <span class="number-item">5</span></td>
                                <td class="bg-dark blackEl oneToTwEl oneToEtEl evenEl"> <span class="number-item">8</span></td>
                                <td class="bg-dark blackEl oneToTwEl oneToEtEl oddEl"> <span class="number-item">11</span></td>
                                <td class="bg-danger redEl thrtToTfEl oneToEtEl evenEl"> <span class="number-item">14</span></td>
                                <td class="bg-dark blackEl thrtToTfEl oneToEtEl oddEl"> <span class="number-item">17</span></td>
                                <td class="bg-dark blackEl thrtToTfEl nineteenTtsixEl evenEl"><span class="number-item">20</span></td>
                                <td class="bg-danger redEl thrtToTfEl nineteenTtsixEl oddEl"> <span class="number-item">23</span></td>
                                <td class="bg-dark blackEl twfToTsEl nineteenTtsixEl evenEl"> <span class="number-item">26</span></td>
                                <td class="bg-dark blackEl twfToTsEl nineteenTtsixEl oddEl"> <span class="number-item">29</span></td>
                                <td class="bg-danger redEl twfToTsEl nineteenTtsixEl evenEl"> <span class="number-item">32</span></td>
                                <td class="bg-dark blackEl twfToTsEl nineteenTtsixEl oddEl"> <span class="number-item">35</span></td>
                                <td class="twByOne2 p-0">
                                    <button class="btn-color" type="button">2:1</button>
                                    <input type="hidden" value="0">
                                </td>
                            </tr>
                            <tr class="numbers">
                                <td class="bg-danger redEl oneToTwEl oneToEtEl oddEl"> <span class="number-item">1</span></td>
                                <td class="bg-dark blackEl oneToTwEl oneToEtEl evenEl"> <span class="number-item">4</span></td>
                                <td class="bg-danger redEl oneToTwEl oneToEtEl oddEl"> <span class="number-item">7</span></td>
                                <td class="bg-dark blackEl oneToTwEl oneToEtEl evenEl"> <span class="number-item">10</span></td>
                                <td class="bg-dark blackEl thrtToTfEl oneToEtEl oddEl"> <span class="number-item">13</span></td>
                                <td class="bg-danger redEl thrtToTfEl oneToEtEl evenEl"> <span class="number-item">16</span></td>
                                <td class="bg-danger redEl thrtToTfEl nineteenTtsixEl oddEl"> <span class="number-item">19</span></td>
                                <td class="bg-dark blackEl thrtToTfEl nineteenTtsixEl evenEl"> <span class="number-item">22</span></td>
                                <td class="bg-danger redEl twfToTsEl nineteenTtsixEl oddEl"> <span class="number-item">25</span></td>
                                <td class="bg-dark blackEl twfToTsEl nineteenTtsixEl evenEl"> <span class="number-item">28</span></td>
                                <td class="bg-dark blackEl twfToTsEl nineteenTtsixEl oddEl"> <span class="number-item">31</span></td>
                                <td class="bg-danger redEl twfToTsEl nineteenTtsixEl evenEl"> <span class="number-item">34</span></td>
                                <td class="twByOne3 p-0">
                                    <button class="btn-color" type="button">2:1</button>
                                    <input type="hidden" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td class="border-0"></td>
                                <td class="oneToTw text-center" colspan="4">
                                    <button class="w-100 btn-color" type="button"><span>1 to 12</span></button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="thrtToTf text-center" colspan="4">
                                    <button class="w-100 btn-color" type="button">
                                        <span>13 to 24</span></button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="twfToTs text-center" colspan="4">
                                    <button class="w-100 btn-color" type="button">
                                        <span>25 to 36</span></button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="border-0"></td>
                            </tr>
                            <tr>
                                <td class="border-0"></td>
                                <td class="oneToEt text-center" colspan="2">
                                    <button class="w-100 btn-color" type="button"><span>1 to 18</span>
                                    </button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="even text-center" colspan="2">
                                    <button class="w-100 btn-color" type="button"><span>@lang('Even')</span>
                                    </button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="bg-danger red text-center" colspan="2">
                                    <span>@lang('Red')</span><input type="hidden" value="0">
                                </td>
                                <td class="bg-dark black text-center" colspan="2">
                                    <span>@lang('Black')</span>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="odd text-center" colspan="2">
                                    <button class="w-100 btn-color" type="button"><span>@lang('Odd')</span>
                                    </button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="nineteenTtsix text-center" colspan="2">
                                    <button class="w-100 btn-color" type="button">
                                        <span>19 to 36</span></button>
                                    <input type="hidden" value="0">
                                </td>
                                <td class="border-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
    <link href="{{ asset('assets/global/css/game/roulette.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/game/roulette-wheel.css') }}" rel="stylesheet">
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/game/hammer.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/game/roulette.js') }}"></script>
    <script src="{{ asset('assets/global/js/game/roulette-wheel.js') }}"></script>
@endpush

@push('style')
    <style>
        .selected {
            color: #041a34;
            background: linear-gradient(#5b4516,
                    #b4903a 5%,
                    #b4903a,
                    #fffea6,
                    #d6b65f,
                    #b4903a,
                    #b4903a,
                    #5b4516 100%);
        }



        @media (max-width:991px) {
            .game--card {
                width: unset;
            }

            .game-wrapper div:nth-child(1) {
                order: 1;
            }

            .game-wrapper div:nth-child(2) {
                order: 3;
            }

            .game-wrapper div:nth-child(3) {
                order: 2;
            }
        }

        @media (max-width:767px) {
            .roulette-wrapper {
                height: 728px;
            }
        }

        @media (max-width:424px) {
            .plate {
                background-color: #492e9b;
                width: 180px;
                height: 180px;
                border-radius: 50%;
                position: relative;
                display: inline-block;
                text-align: left;
            }

            .plate:before {
                top: 16%;
                left: 16%;
                right: 16%;
                bottom: 16%;
                z-index: 1;
            }

            .plate:after {
                top: -3px;
                bottom: -8px;
            }

            .inner {
                display: block;
                height: 180px;
                width: 180px;
                position: relative;
            }

            .inner:before {
                top: 25%;
                bottom: 25%;
                left: 28%;
                right: 26%;
            }

            .number {
                height: 58px;
                top: -2px;
                left: calc(42%);
            }

            .pit {
                color: #fff;
                padding-top: 12px;
                width: 32px;
                transform: scale(1, 1.8);
                position: absolute;
                top: -98px;
                left: -19px;
            }
        }
    </style>
@endpush

@push('script')
    <script>
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


        $('td').on('click', function(e) {
            getBonus()
            playAudio('click.mp3')
        });

        $('[name=invest]').on('input', function(e) {
            getBonus()
        });

        function getBonus() {
            var total = $('table').find(".selected").not('.twByOne1, .twByOne2, .twByOne3').length;
            var amount = $('[name=invest]').val();
            if (amount && total) {
                var bonus = amount * (36 / total);
                $('.win-bonus').text(`@lang('Get Bonus') : ${Math.abs(bonus)} {{ gs('cur_text') }}`)
            }
        }

        var running = 0;
        $('.play-btn').on('click', function() {
            if (!$('[name=invest]').val()) {
                notify('error', 'Invest amount is required')
                return;
            }
            if (!$('[name=choose]').val()) {
                notify('error', 'Card selection is required')
                return;
            }

            $('.inner').removeAttr('data-spinto');
            $('.win-bonus').text('');
            if (running == 1) {
                notify('error', 'Already 1 game is running');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                }
            });
            var url = '{{ route('user.play.roulette.submit') }}';
            var data = {
                invest: $('input[name=invest]').val(),
                choose: $('input[name=choose]').val(),
            };
            $('.play-btn').html('<i class="fas fa-spinner fa-spin"></i>');
            running = 1;
            $.post(url, data, function(response) {
                if (response.error) {
                    running = 0;
                    notify('error', response.error);
                    $('.play-btn').html(`@lang('Play')`);
                    $("td").removeClass("selected");
                    $('input[name=invest]').val("{{ getAmount($game->min_limit) }}");
                    return false;
                }

                $('.user-balance').text(parseFloat(response.balance).toFixed(2));
                $('.roulette-game-spin').addClass('spin-active');

                playAudio('start.mp3');
                let audio = new Audio(`{{ asset('assets/audio/spin.mp3') }}`)
                audio.play()

                // remove the spinto data attr so the ball 'resets'
                $inner.attr('data-spinto', '').removeClass('rest');
                $(this).hide();
                $spin.show();
                $data.removeClass('reveal');
                // get a random number between 0 and 36 and apply it to the nth-child selector
                var randomNumber = response.result;
                color = null;
                $inner.attr('data-spinto', randomNumber).find('li:nth-child(' + randomNumber + ') input').prop('checked', 'checked');
                // prevent repeated clicks on the spin button by hiding it
                $(this).hide();
                // disable the reset button until the ball has stopped spinning
                $reset.addClass('disabled').prop('disabled', 'disabled').show();

                $('.placeholder').remove();


                setTimeout(function() {
                    $mask.text('');
                }, timer / 2);

                setTimeout(function() {
                    $mask.text(maskDefault);
                }, timer + 500);
                // remove the disabled attribute when the ball has stopped
                setTimeout(function() {
                    $reset.removeClass('disabled').prop('disabled', '');

                    if ($.inArray(randomNumber, red) !== -1) {
                        color = 'red'
                    } else {
                        color = 'black'
                    };
                    if (randomNumber == 0) {
                        color = 'green'
                    };

                    $('.result-number').text(randomNumber);
                    $('.result-color').text(color);
                    $('.result').css({
                        'background-color': '' + color + ''
                    });
                    $data.addClass('reveal');
                    $inner.addClass('rest');

                    $thisResult = '<li class="previous-result color-' + color + '"><span class="previous-number">' + randomNumber + '</span><span class="previous-color">' + color + '</span></li>';

                    $('.previous-list').prepend($thisResult);

                    var url = '{{ route('user.play.roulette.result') }}';
                    var data = {
                        gameLog_id: response.gameLog_id,
                        winNumber: response.result
                    }
                    var resStatus = 0;
                    $.post(url, data, function(response) {
                        audio.pause()
                        if (response.error) {
                            playAudio('lose.wav')
                            running = 0;
                            notify('error', response.error);
                            $('.play-btn').html(`@lang('Play')`);
                            $("td").removeClass("selected");
                            $('input[name=invest]').val("{{ showAmount($game->min_limit) }}");
                            return false;
                        }
                        $(".win-loss-popup").addClass("active");
                        $(".win-loss-popup__body").find("img").addClass("d-none");
                        if (response.win === 1) {
                            playAudio('win.wav');
                            $(".win-loss-popup__body").find(".win").removeClass("d-none");
                        } else {
                            playAudio('lose.wav');
                            $(".win-loss-popup__body").find(".lose").removeClass("d-none");
                        }
                        $(".win-loss-popup__footer").find(".data-result").text(randomNumber);
                        $('.user-balance').text(parseFloat(response.balance).toFixed(2));
                        $('.roulette-game-spin').removeClass('spin-active');
                        $("td").removeClass("selected");
                        $('input[name=invest]').val("{{ showAmount($game->min_limit) }}");

                    })
                    $('.play-btn').html(`@lang('Play')`);
                    running = 0;
                }, timer);
            })
        })

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
