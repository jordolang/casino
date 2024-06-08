@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-4">
        <div class="col-lg-6 mt-lg-0 mt-5">
            <div class="game--card">
                <div class="mine-box-wrapper">
                    @for ($i = 1; $i <= 25; $i++)
                        <div class="mine-box mineBox gold-box" id="mine{{ $i }}">
                            <div class="mine-box-wrapper">
                                <div class="mine-box-front">
                                    <img src="{{ asset($activeTemplateTrue . 'images/mines/box.png') }}" alt="@lang('image')">
                                </div>
                                <div class="mine-box-hidden"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="game--card">
                <h4 class="game-contet-title">@lang('Current Balance'): <span class="text balance">{{ showAmount(auth()->user()->balance, currencyFormat: false) }}</span> {{ __(gs('cur_text')) }}</h4>
                <div class="form-group bet-input">
                    <label class="form-label">@lang('Bet Amount')</label>
                    <div class="input-group">
                        <span class="input-group-text">{{ gs('cur_sym') }}</span>
                        <input type="number" step="any" class="form-control form--control" placeholder="@lang('Enter amount')" name="invest">
                        <button type="button" class="input-group-text minmax-btn minBtn">@lang('Min')</button>
                        <button type="button" class="input-group-text minmax-btn maxBtn">@lang('Max')</button>
                    </div>

                    <div class="fw-light mt-3 d-inline-block input-inner-note">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle mr-2"></i> @lang('Minimum :') {{ showAmount($game->min_limit) }}
                            | @lang('Maximum :') {{ showAmount($game->max_limit) }}
                        </small>

                    </div>
                </div>
                <div class="form-group mines-input">
                    <label class="form-label">@lang('Number of Mines')</label>
                    <input type="number" class="form-control form--control mines-number" name="mines" min="1" max="20">
                </div>

                <div class="gold-mine-box"></div>

                <div class="form-submit game-playbtn mt-5">
                    <button type="button" class="btn btn--gradient w-100 betBtn">@lang('Start Game')</button>
                    <button type="button" class="btn btn--gradient w-100 d-none  cashoutBtn">@lang('Cashout')</button>
                </div>
                <button type="button" class="d-block text-white text-center mx-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i
                       class="fas fa-info-circle mr-2"></i>
                    @lang(' Game Instruction')
                </button>
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
    <style>
        .minmax-btn {
            position: relative;
        }

        .minmax-btn:not(:last-child)::after {
            content: "";
            position: absolute;
            height: 20px;
            width: 2px;
            background-color: hsl(var(--black));
            top: 50%;
            transform: translateY(-50%);
            right: 0;
        }

        .mines-number {
            border-radius: 12px;
        }

        .gold-mine-box {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/global/js/game/mines.js') }}"></script>
    <script>
        "use strict";
        (function($) {
            let minLimit = Number("{{ $game->min_limit }}");
            let maxLimit = Number("{{ $game->max_limit }}");
            let currency = "{{ gs('cur_text') }}";
            let userBalance = Number("{{ auth()->user()->balance }}");
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

            $('.betBtn').on('click', function(e) {

                let invest = investField.val();
                let mines = minesField.val();

                if (!invest) {
                    notify('error', `Amount field is required`);
                    return;
                }
                if (!mines) {
                    notify('error', `Mines field is required`);
                    return;
                }

                if (minLimit > invest) {
                    notify('error', `Minimum bet amount is ${minLimit} `);
                    return;
                }

                if (invest > maxLimit) {
                    notify('error', `Maximum bet amount is ${minLimit} `);
                    return;
                }

                if (mines > 20) {
                    notify('error', `Maximum mines amount is 20`);
                    return;
                }

                if (invest > userBalance) {
                    notify('error', `You have no sufficient balance`);
                    return;
                }

                audio = new Audio(`{{ asset('assets/audio/start.mp3') }}`);
                audio.play()

                betBtn.prop('disabled', true);
                betBtn.addClass('d-none');

                let url = "{{ route('user.play.game.invest', 'mines') }}"
                let data = {
                    _token: "{{ csrf_token() }}",
                    invest: invest,
                    mines: mines
                }
                game(url, data);
            });

            $('.mineBox').on('click', function(e) {
                audio = new Audio(`{{ asset('assets/audio/click.mp3') }}`);
                audio.play()
                let mineUrl = "{{ route('user.play.game.end', 'mines') }}"
                let mineData = {
                    _token: "{{ csrf_token() }}",
                    game_id: gameLogId
                }
                mineBox = $(this);
                gameEnd(mineUrl, mineData);
            });

            $('.cashoutBtn').on('click', function(e) {
                let cashoutUrl = "{{ route('user.play.mine.cashout') }}"
                let cashoutData = {
                    _token: "{{ csrf_token() }}",
                    game_id: gameLogId
                }
                cashout(cashoutUrl, cashoutData);
            });
        })(jQuery)
    </script>
@endpush
