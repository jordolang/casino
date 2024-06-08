@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="game-details-right mt-4">
                        <div class="game-card-body dice-game-body">
                            <div class="dice-box">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-lg-10 text-center">
                                        <div class="row justify-content-center">
                                            <div class="col-md-2 col-3">
                                                <span class="dice-item first">0</span>
                                            </div>
                                            <div class="col-md-2 col-3">
                                                <span class="dice-item second">0</span>
                                            </div>
                                            <div class="col-md-2 col-3">
                                                <span class="dice-item third">0</span>
                                            </div>
                                            <div class="col-md-2 col-3">
                                                <span class="dice-item fourth">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <div class="dice-game-range-slider">
                                            <div class="range-holder" style="background-image: url('{{ asset($activeTemplateTrue . 'images/range-bg.png') }}')"></div>
                                            <input class="w-100 input-capsule dice-value" type="range" value="1" min="1" max="98">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center gy-4 mt-3">
                                    <div class="col-lg-6">
                                        <label>@lang('Enter Amount')</label>
                                        <div class="input-group">
                                            <input class="form-control" name="invest" type="number" value="{{ getAmount($game->min_limit) }}" autocomplete="off">
                                            <span class="input-group-text min cursor-pointer">@lang('min')</span>
                                            <span class="input-group-text less cursor-pointer">-10</span>
                                            <span class="input-group-text more cursor-pointer">+10</span>
                                            <span class="input-group-text max cursor-pointer">@lang('max')</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>@lang('Win Chance')</label>
                                        <div class="input-group">
                                            <input class="form-control" name="percent" type="number" value="1" min="1" max="98" autocomplete="off">
                                            <span class="input-group-text">%</span>
                                            <span class="input-group-text min-percent cursor-pointer">@lang('min')</span>
                                            <span class="input-group-text less-percent cursor-pointer">-5</span>
                                            <span class="input-group-text more-percent cursor-pointer">+5</span>
                                            <span class="input-group-text max-percent cursor-pointer">@lang('max')</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>@lang('Bonus')</label>
                                        <div class="input-group">
                                            <input class="payout form-control" type="text" value="99" autocomplete="off" readonly>
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>@lang('Current Balance')</label>
                                        <div class="input-group">
                                            <input class="balance form-control" type="text" value="{{ showAmount(auth()->user()->balance, currencyFormat: false) }}" autocomplete="off" readonly>
                                            <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 flex-wrap gap-3">
                                    <button class="cmn-btn range-btn min-btn" type="submit" value="low">@lang('Low') < <span class="min-number">100</span></button>
                                    <button class="cmn-btn range-btn max-btn" type="submit" value="high">@lang('High') > <span class="max-number">9899</span></button>
                                </div>
                            </div>
                        </div>
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

@push('style-lib')
    <link href="{{ asset('assets/global/css/game/casino-dice.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>
        .dice-game-range-slider .range-holder {
            background-image: linear-gradient(90deg,
                    #ac7a35 0%,
                    #e2a31a 35%,
                    #fc9403 100%) !important;
        }

        .dice-box .dice-item {
            background: rgb(172 122 53 / .1);
            color: rgb(232 149 35);
        }

        .payment-item__btn p,
        span {
            color: #000000;
        }
    </style>
@endpush

@push('script')
    <script>
        function randomNumber() {
            var min = 0;
            var max = 9;
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        $('.dice-value').on('input', function() {
            var val = $(this).val();
            percentValue(val);
        });

        $('input[name=percent]').on('input', function() {
            var val = $(this).val();
            percentValue(val);
        });

        $('.min-percent').click(function() {
            percentValue(1);
            playAudio('click.mp3');
        })

        $('.max-percent').click(function() {
            percentValue(98);
            playAudio('click.mp3');
        })

        $('.less-percent').click(function() {
            val = $('input[name=percent]').val() - 5;
            if (val < 5) {
                return false;
            }
            percentValue(val);
            playAudio('click.mp3');
        })

        $('.more-percent').click(function() {
            val = parseFloat($('input[name=percent]').val()) + 5;
            if (val > 98) {
                return false;
            }
            percentValue(val);
            playAudio('click.mp3');
        })

        function percentValue(val) {
            $('.dice-value').val(val);
            $('input[name=percent]').val(val);
            $('.min-number').text(val * 100);
            $('.max-number').text(9900 - (val * 100) + 99);
            $('.payout').val((99 / val).toFixed(4));
        }


        $('.less').click(function() {
            val = $('input[name=invest]').val() - 10;
            if (val < {{ getAmount($game->min_limit) }}) {
                return false;
            }
            $('input[name=invest]').val(val);
            playAudio('click.mp3');
        })

        $('.more').click(function() {
            val = parseFloat($('input[name=invest]').val()) + 10;
            if (val > {{ getAmount($game->max_limit) }}) {
                return false;
            }
            $('input[name=invest]').val(val);
            playAudio('click.mp3');
        })

        $('.min').click(function() {
            $('input[name=invest]').val({{ getAmount($game->min_limit) }});
            playAudio('click.mp3');
        })

        $('.max').click(function() {
            $('input[name=invest]').val({{ getAmount($game->max_limit) }});
            playAudio('click.mp3');
        })

        // game.dice.submit
        var running = 0;
        $('.range-btn').click(function() {
            if (running == 1) {
                notify('error', 'Already 1 game is running');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = '{{ route('user.play.dice.submit') }}';
            var data = {
                percent: $('[name=percent]').val(),
                invest: $('[name=invest]').val(),
                range: $(this).val(),
            };
            $('.range-btn').html('<i class="fas fa-spinner fa-spin"></i>');
            val = $('[name=percent]').val();
            running = 1;
            $.post(url, data, function(response) {
                if (response.error) {
                    running = 0;
                    notify('error', response.error);
                    $('.min-btn').html(`@lang('Low') < <span class="min-number">${val * 100}</span>`);
                    $('.max-btn').html(`@lang('High') > <span class="max-number">${9900 - (val * 100) + 99}</span>`);
                    return false;
                }

                $('.balance').val(Math.abs(response.balance))
                let audio = new Audio(`{{ asset('assets/audio/casino-dice.mp3') }}`);
                audio.play();

                var timesRun = 0;
                var getResult = 0;
                var sentRequest = 0;
                var resp = null;
                var interval = setInterval(function() {
                    timesRun += 1;
                    if (timesRun >= 60) {
                        var url = '{{ route('user.play.dice.result') }}';
                        var data = {
                            game_id: response.gameLog_id
                        }
                        if (sentRequest == 0) {
                            $.post(url, data, function(updateResponse) {
                                getResult = 1;
                                audio.pause();
                                if (updateResponse.error) {
                                    running = 0;
                                    notify('error', updateResponse.error);
                                    $('.min-btn').html(`@lang('Low') < <span class="min-number">${val * 100}</span>`);
                                    $('.max-btn').html(`@lang('High') > <span class="max-number">${9900 - (val * 100) + 99}</span>`);
                                    return false;
                                }

                                $('.balance').val(Math.abs(updateResponse.balance))
                                $(".win-loss-popup").addClass("active");
                                $(".win-loss-popup__body").find("img").addClass("d-none");
                                if (updateResponse.win == 1) {
                                    $(".win-loss-popup__body").find(".win").removeClass("d-none");
                                } else {
                                    $(".win-loss-popup__body").find(".lose").removeClass("d-none");
                                }
                                $(".win-loss-popup__footer").find(".data-result").text(updateResponse.result);
                                resp = updateResponse;
                            })
                        }
                        sentRequest = 1;
                        $('.min-btn').html(`@lang('Low') < <span class="min-number">${val * 100}</span>`);
                        $('.max-btn').html(`@lang('High') > <span class="max-number">${9900 - (val * 100) + 99}</span>`);
                        if (getResult == 1) {
                            $(".win-loss-popup").addClass("active");
                            $(".win-loss-popup__body").find("img").addClass("d-none");
                            if (resp.win === 1) {
                                playAudio('win.wav');
                                $(".win-loss-popup__body").find(".win").removeClass("d-none");
                            } else {
                                playAudio('lose.wav');
                                $(".win-loss-popup__body").find(".lose").removeClass("d-none");
                            }
                            $(".win-loss-popup__footer").find(".data-result").text(response.result);

                            var myRes = resp.result.toString();
                            $('.first').text(myRes[0]);
                            $('.second').text(myRes[1]);
                            $('.third').text(myRes[2]);
                            $('.fourth').text(myRes[3]);
                            running = 0;
                            clearInterval(interval);
                        }

                    }
                    if (getResult == 0) {
                        $('.first').text(randomNumber());
                        $('.second').text(randomNumber());
                        $('.third').text(randomNumber());
                        $('.fourth').text(randomNumber());
                    }
                }, 70)

            })
        });

        function playAudio(filename) {
            var audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
