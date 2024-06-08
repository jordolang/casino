@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $kyc = getContent('user_kyc.content', true);
    @endphp
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="notice"></div>
            <div class="row mb-3">
                <div class="col-md-12">
                    @if ($user->kv == Status::KYC_UNVERIFIED && $user->kyc_rejection_reason)
                        <div class="d-widget" role="alert">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <h4 class="alert-heading text--danger">@lang('KYC Documents Rejected')</h4>
                                <button class="btn btn--danger btn--sm" data-bs-toggle="modal" data-bs-target="#kycRejectionReason">@lang('Show Reason')</button>
                            </div>
                            <hr>
                            <p class="mb-0">{{ __(@$kyc->data_values->reject) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Re-submit Documents')</a>.</p>
                            <br>
                            <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>
                        </div>
                    @elseif ($user->kv == Status::KYC_UNVERIFIED)
                        <div class="d-widget" role="alert">
                            <h4 class="alert-heading text--danger">@lang('KYC Verification required')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kyc->data_values->verification_content) }} <a class="text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here to Submit Documents')</a></p>
                        </div>
                    @elseif($user->kv == Status::KYC_PENDING)
                        <div class="d-widget" role="alert">
                            <h4 class="alert-heading text--warning">@lang('KYC Verification pending')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kyc->data_values->pending_content) }} <a class="text--base" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-balance">
                        <div class="d-widget-icon">
                            <i class="las la-money-bill-wave"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Balance')</p>
                            <h2 class="title">{{ showAmount($widget['total_balance']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-deposit">
                        <div class="d-widget-icon">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Deposit')</p>
                            <h2 class="title">{{ showAmount($widget['total_deposit']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-withdraw">
                        <div class="d-widget-icon">
                            <i class="las la-hand-holding-usd"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Withdraw')</p>
                            <h2 class="title">{{ showAmount($widget['total_withdrawn']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-invest">
                        <div class="d-widget-icon">
                            <i class="las la-cash-register"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Invest')</p>
                            <h2 class="title">{{ showAmount($widget['total_invest']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-win">
                        <div class="d-widget-icon">
                            <i class="las la-trophy"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Win')</p>
                            <h2 class="title">{{ showAmount($widget['total_win']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-loss">
                        <div class="d-widget-icon">
                            <i class="las la-money-bill-alt"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Loss')</p>
                            <h2 class="title">{{ showAmount($widget['total_loss']) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @forelse($games as $game)
                    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                        <div class="game-card style--two">
                            <div class="game-card__thumb">
                                <img src="{{ getImage(getFilePath('game') . '/' . $game->image, getFileSize('game')) }}" alt="image">
                            </div>
                            <div class="game-card__content">
                                <h4 class="game-name">{{ __($game->name) }}</h4>
                                <a class="cmn-btn d-block btn-sm btn--capsule mt-3 text-center" href="{{ route('user.play.game', $game->alias) }}">@lang('Play Now')</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">{{ __($emptyMessage) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @if ($user->kv == Status::KYC_UNVERIFIED && $user->kyc_rejection_reason)
        <div class="modal fade" id="kycRejectionReason">
            <div class="modal-dialog" role="document">
                <div class="modal-content section--bg">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
                        <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <p>{{ $user->kyc_rejection_reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
