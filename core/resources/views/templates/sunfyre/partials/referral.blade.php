@php
    $referralContent = getContent('referral.content', true);
@endphp

<div class="games-callaction">
    <div class="games-callaction__wrapper bg-img" data-background-image="{{ getImage('assets/images/frontend/referral/' . @$referralContent->data_values->image, '760x135') }}">
        <div class="games-callaction__content">
            <h4 class="games-callaction__title">{{ __($referralContent->data_values->heading) }}</h4>
            <p class="games-callaction__desc">{{ __($referralContent->data_values->description) }}</p>
        </div>
        <div class="games-callaction__button">
            <a href="{{ url($referralContent->data_values->button_url) }}" class="btn btn--gradient">{{ __($referralContent->data_values->button_name) }}</a>
        </div>
    </div>
</div>

@push('style')
    <style>
        @media (max-width:767px) {
            .bg-img {
                background-image: none !important;
            }
        }
    </style>
@endpush
