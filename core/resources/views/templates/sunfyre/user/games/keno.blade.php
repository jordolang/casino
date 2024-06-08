@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-5 gx-lg-5 align-items-center">
        <div class="col-lg-7">
            <div class="game--card">
                <div class="keno-number-plate" id="grid">
                    @for ($i = 1; $i <= 80; $i++)
                        <button class="slot" data-slot="{{ $i }}" number="{{ $i }}">
                            {{ getAmount($i) }}
                        </button>
                    @endfor
                </div>
                <form class="mt-5" id="game" action="" method="POST">
                    <div class="d-flex justify-content-between mb-3 flex-wrap gap-3">
                        <button class="d-block text-white" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">@lang('Game Instruction')
                            <i class="las la-info-circle"></i>
                        </button>
                        <div class="action-area">
                            <button class="random-btn btn--gradient btn-sm" type="button"><i class="las la-random"></i> @lang('Random')</button>
                            <button class="refresh-btn btn--gradient btn-sm" type="button"><i class="las la-undo-alt"></i> @lang('Refresh')</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">{{ gs('cur_sym') }}</span>
                            <input type="number" step="any" class="form-control form--control" placeholder="@lang('Enter amount')" name="invest" value="{{ old('invest') }}">
                            <button type="button" class="input-group-text minmax-btn minBtn">@lang('Min')</button>
                            <button type="button" class="input-group-text minmax-btn maxBtn">@lang('Max')</button>
                        </div>
                        <small class="fw-light mt-3 d-inline-block input-inner-note">
                            <i class="fas fa-info-circle mr-2"></i> @lang('Minimum :') {{ showAmount($game->min_limit) }}
                            | @lang('Maximum :') {{ showAmount($game->max_limit) }}
                        </small>
                    </div>
                    <div class="form-submit game-playbtn">
                        <button type="submit" class="btn btn--gradient w-100">@lang('Play Now')</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="game--card">
                <h4 class="game-contet-title mb-3">@lang('How To Win ?')</h4>
                <p class="keno-history-content__desc">
                    <span class="text--base">{{ $game->level->max_select_number }}</span> @lang('number that are on your scratch off, and then click ') <strong class="text--base">@lang('"play Now"')</strong> @lang('button to see if you are a winner!')
                </p>

                <div class="keno-history">
                    <ul class="keno-history__list">
                        @foreach ($game->level->levels as $item)
                            <li class="keno-history__item">
                                <span class="keno-history__text">@lang('If match '){{ getAmount($item->level) }} @lang('number')</span>
                                <span class="keno-history__count">{{ showAmount($item->percent) }}%</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
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


@push('style-lib')
    <link href="{{ asset('assets/global/css/game/keno.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>
        .keno-number-plate .slot {
            height: 40px;
            border-radius: 6px;
            box-shadow: -2px 2px 0px #dcc86c;
        }

        .keno-number-plate .win {
            box-shadow: -2px 2px 0px #39fd91;
        }

        @media(max-width: 767px) {
            .keno-number-plate .slot {
                height: 32px;
                font-size: 14px;
            }
        }

        .random-btn,
        .refresh-btn {
            padding: 5px 12px !important;
            font-size: 17px;
            border-radius: 6px;
            background: linear-gradient(180deg,
                    hsl(var(--base-l-300)) 5%,
                    hsl(var(--base-two)) 108%);
            border: 0;
            border-bottom: 4px solid hsl(var(--base-l-100)) !important;
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

        let slotNumbers = [];
        let maxSelectNumber = "{{ $game->level->max_select_number }}";
        $('.slot').on('click', function(e) {

            if ($('.slot').hasClass('win') || $('.slot').hasClass('loss')) {
                notify('error', 'You have to refresh number slot');
                return;
            }

            if ($(this).hasClass('active')) {
                notify('error', 'Already select this number');
                return;
            }

            let activeSlotNumber = $('.slot.active').length;
            if (activeSlotNumber >= maxSelectNumber) {
                notify('error', `You have to select max ${maxSelectNumber} number`);
                return;
            }

            var slotNumber = Number($(this).data('slot'));
            if (slotNumbers.includes(slotNumber)) {
                notify('error', `You already selected this number`);
                return;
            }
            playAudio('keno.wav')
            slotNumbers.push(slotNumber);
            $(this).addClass('active');
            $(this).attr('disabled', true)
        });

        $('.refresh-btn').on('click', function(e) {
            refreshSlot();
            playAudio('keno.wav')
        });

        $('.random-btn').on('click', function(e) {
            playAudio('keno.wav')
            randomSlot(3)
        });

        let totalSetTimeOut = 0;

        function randomSlot(maxLimit) {
            for (let j = 0; j < maxLimit; j++) {
                totalSetTimeOut = totalSetTimeOut + j * 100;
                setTimeout(function() {
                    refreshSlot();
                    slotNumbers = [];
                    while (slotNumbers.length < maxSelectNumber) {
                        var randomValue = Math.floor(Math.random() * 80) + 1;
                        if (!slotNumbers.includes(randomValue)) {
                            slotNumbers.push(randomValue);
                        }
                    }
                    for (let k = 0; k < maxSelectNumber; k++) {
                        var slot = $(`.slot[number="${slotNumbers[k]}"]`);
                        slot.addClass('active');
                        slot.attr('disabled', true);
                    }
                }, j * 100);
            }
        }

        function refreshSlot() {
            $('.slot').removeClass('active').removeAttr('disabled');
            $('.slot').removeClass('win');
            $('.slot').removeClass('loss');
            $('.cmn-btn').removeAttr('disabled')
            slotNumbers = [];
        }

        $("#game").on('submit', function(e) {
            e.preventDefault();
            totalSetTimeOut = 0;

            if ($('.slot').hasClass('win') || $('.slot').hasClass('loss')) {
                notify('error', 'You have to refresh number slot');
                return;
            }

            let data = {
                _token: "{{ csrf_token() }}",
                invest: $('[name=invest]').val(),
                choose: slotNumbers
            };
            if (data.invest < 1) {
                notify('error', 'Invest value is required');
                return;
            }
            if (slotNumbers.length != maxSelectNumber) {
                notify('error', `You have to select minimum ${maxSelectNumber} number`);
                return;
            }


            $('.cmn-btn').attr('disabled', true);
            playAudio('keno_start.wav');

            $.ajax({
                type: "POST",
                url: "{{ route('user.play.keno.submit') }}",
                data: data,
                success: function(response) {
                    if (response.error) {
                        audio.pause()
                        notify('error', response.error);
                        $('.cmn-btn').removeAttr('disabled');
                        return;
                    } else {
                        randomSlot(5);
                        $('[name=invest]').val(0);
                        setTimeout(() => {
                            refreshSlot();
                            endGame(response);
                        }, totalSetTimeOut);
                    }
                }
            });

        });

        function endGame(response) {
            for (let i = 0; i < response.user_select.length; i++) {
                var slot = $(`.slot[number="${response.user_select[i]}"]`);
                if (response.match_number.length == 0) {
                    slot.addClass('loss')
                } else {
                    slot.addClass('active');
                }
                slot.attr('disabled', true);
            }
            for (let j = 0; j < response.match_number.length; j++) {
                var slot = $(`.slot[number="${response.match_number[j]}"]`);
                slot.addClass('win');
            }
            var totalMatched = response.match_number.length;
            let data = {
                _token: "{{ csrf_token() }}",
                gameLog_id: response.game_log_id,
            }
            $.ajax({
                type: "POST",
                url: "{{ route('user.play.keno.update') }}",
                data: data,
                success: function(response) {
                    audio.pause();
                    totalSetTimeOut = 0;
                    $(".win-loss-popup").addClass("active");
                    $(".win-loss-popup__body").find("img").addClass("d-none");
                    if (response.win === 1) {
                        playAudio('win.wav');
                        $(".win-loss-popup__body").find(".win").removeClass("d-none");
                    } else {
                        playAudio('lose.wav');
                        $(".win-loss-popup__body").find(".lose").removeClass("d-none");
                    }
                    $(".win-loss-popup__footer").find(".data-result").text(response.result);
                    $(".win-loss-popup__footer").find('h5').text(`@lang('Total ${totalMatched} number matched')`)
                }
            });
        }

        function playAudio(filename) {
            audio = new Audio(`{{ asset('assets/audio') }}/${filename}`);
            audio.play();
        }
    </script>
@endpush
