@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="notice"></div>
    @php
        $kyc = getContent('user_kyc.content', true);
    @endphp
    @if ($user->kv == Status::KYC_UNVERIFIED && $user->kyc_rejection_reason)
        <div class="card custom--card mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h4 class="alert-heading text--danger">@lang('KYC Documents Rejected')</h4>
                    <button class="btn btn--danger btn--sm" data-bs-toggle="modal" data-bs-target="#kycRejectionReason">@lang('Show Reason')</button>
                </div>
                <hr>
                <p class="mb-0">{{ __(@$kyc->data_values->reject) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Re-submit Documents')</a>.</p>
                <br>
                <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>
            </div>
        </div>
    @elseif ($user->kv == Status::KYC_UNVERIFIED)
        <div class="card custom--card mb-5">
            <div class="card-body">
                <h4 class="text--danger">@lang('KYC Verification required')</h4>
                <hr>
                <p>{{ __(@$kyc->data_values->verification_content) }} <a class="text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here to Submit Documents')</a></p>
            </div>
        </div>
    @elseif($user->kv == Status::KYC_PENDING)
        <div class="card custom--card mb-5">
            <div class="card-body">
                <h4 class="text--warning">@lang('KYC Verification pending')</h4>
                <hr>
                <p>{{ __(@$kyc->data_values->pending_content) }} <a class="text--base" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
            </div>
        </div>
    @endif

    <div class="info-wrapper">
        <div class="info-card">
            <div class="info-card__icon">
                <i class="icon icon-Money-Bag"></i>
            </div>
            <div class="info-card__content">
                <p class="info-card__desc mb-2">@lang('Total Balance')</p>
                <h4 class="info-card__title mb-0">{{ showAmount($widget['total_balance']) }}</h4>
            </div>
        </div>
        <div class="info-card">
            <div class="info-card__icon">
                <i class="icon icon-Deposit-1"></i>
            </div>
            <div class="info-card__content">
                <p class="info-card__desc mb-2">@lang('Total Deposit')</p>
                <h4 class="info-card__title mb-0">{{ showAmount($widget['total_deposit']) }}</h4>
            </div>
        </div>
        <div class="info-card">
            <div class="info-card__icon">
                <i class="icon icon-withdraw-1"></i>
            </div>
            <div class="info-card__content">
                <p class="info-card__desc mb-2">@lang('Total Withdraw')</p>
                <h4 class="info-card__title mb-0">{{ showAmount($widget['total_withdrawn']) }}</h4>
            </div>
        </div>
        <div class="info-card">
            <div class="info-card__icon">
                <i class="icon icon-Group-86"></i>
            </div>
            <div class="info-card__content">
                <p class="info-card__desc mb-2">@lang('Total Invest')</p>
                <h4 class="info-card__title mb-0">{{ showAmount($widget['total_invest']) }}</h4>
            </div>
        </div>
        <div class="info-card">
            <div class="info-card__icon">
                <i class="icon icon-trophy"></i>
            </div>
            <div class="info-card__content">
                <p class="info-card__desc mb-2">@lang('Total Win')</p>
                <h4 class="info-card__title mb-0">{{ showAmount($widget['total_win']) }}</h4>
            </div>
        </div>
        <div class="info-card">
            <div class="info-card__icon">
                <i class="icon icon-Layer-21"></i>
            </div>
            <div class="info-card__content">
                <p class="info-card__desc mb-2">@lang('Total Loss')</p>
                <h4 class="info-card__title mb-0">{{ showAmount($widget['total_loss']) }}</h4>
            </div>
        </div>
    </div>

    <div class="games-section pt-100 pb-50">
        <div class="games-section-inner">
            <div class="games-section-wrapper">
                @include($activeTemplate . 'partials.game', ['games' => $games])
            </div>
        </div>
    </div>

    @if ($user->kv == Status::KYC_UNVERIFIED && $user->kyc_rejection_reason)
        <div class="modal custom--modal fade" id="kycRejectionReason">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
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
