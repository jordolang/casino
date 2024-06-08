@php
    $payment = getContent('payment_method.content', true);
    $payments = getContent('payment_method.element', false, null, true);
    $policyPages = getContent('policy_pages.element', false, null, true);
    $socialIcon = getContent('social_icon.element', false, null, true);
    $footer = getContent('footer.content', true);
@endphp
<footer class="footer-area">
    <div class="footer-area__thumb">
        <img src="{{ getImage('assets/images/frontend/footer/' . $footer->data_values->image, '1110x420') }}" alt="@lang('image')">
    </div>
    <div class="payment-method pb-100">
        <div class="container">
            <h4 class="payment-method__title">{{ __(@$payment->data_values->heading) }}</h4>
            <div class="payment-slider">
                @foreach ($payments as $item)
                    <div class="payment-single-item">
                        <div class="payment-item__image">
                            <img src="{{ getImage('assets/images/frontend/payment_method/' . $item->data_values->image, '90x65') }}" alt="@lang('image')">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="footer-bottom py-50">
        <div class="container">
            <div class="footer-bottom__wrapper">
                <a href="" class="footer-bottom__logo">
                    <img src="{{ siteLogo() }}" alt="@lang('image')">
                </a>

                <div class="newsletter">
                    <form class="newsletter__wrapper">
                        <div class="newsletter__input">
                            <input class="form--control" name="email" type="email" placeholder="@lang('Enter email address')" autocomplete="off">
                        </div>
                        <button type="submit" class="newsletter__btn subscribe-btn">@lang('Subscribe')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="socket-area">
        <div class="container">
            <div class="socket-area__wrapper">
                <p class="socket-area__text"> &copy; @lang('Copyright') @php echo date('Y') @endphp . @lang('All rights reserved').</p>
                <ul class="social-list">
                    @foreach ($socialIcon as $social)
                        <li class="social-list__item">
                            <a href="{{ @$social->data_values->url }}" class="social-list__link flex-center">
                                @php echo $social->data_values->social_icon @endphp
                            </a>
                        </li>
                    @endforeach
                </ul>
                <ul class="flex-align socket-nav">
                    @foreach ($policyPages as $policy)
                        <li class="socket-nav__item">
                            <a class="socket-nav__link" href="{{ route('policy.pages', @$policy->slug) }}">{{ __(@$policy->data_values->title) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.subscribe-btn').on('click', function(e) {
                e.preventDefault()
                var email = $('[name=email]').val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ route('subscribe.post') }}",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.success) {
                            $('[name=email]').val('')
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    }
                });
            });
        })(jQuery)
    </script>
@endpush
