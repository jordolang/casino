<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ gs()->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">
    <link href="{{ asset('assets/global/css/lightcase.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/iconmoon.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet">

    @stack('style-lib')
    @stack('style')

    <link href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ gs('base_color') }}&secondColor={{ gs('secondary_color') }}" rel="stylesheet">
</head>

@php echo loadExtension('google-analytics') @endphp

<body>
    @stack('fbComment')

    <div class="preloader">
        <div class="loader-p"></div>
    </div>

    <div class="body-overlay"></div>

    <div class="sidebar-overlay"></div>

    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    @yield('app')

    <div class="win-loss-popup">
        <div class="win-loss-popup__bg">
            <div class="win-loss-popup__inner">
                <div class="win-loss-popup__body">
                    <img class="img-glow lose d-none"
                         src="{{ asset($activeTemplateTrue . 'images/play/lose-message.png') }}"
                         alt="lose message image">
                    <img class="img-glow win d-none"
                         src="{{ asset($activeTemplateTrue . 'images/play/win-message.png') }}" alt="win message image">
                </div>
                <div class="win-loss-popup__footer">
                    <h2 class="result-text">@lang('The result is') <span class="data-result"></span></h2>
                    <h5></h5>
                </div>
            </div>
        </div>
    </div>

    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp

    @if ($cookie->data_values->status == Status::ENABLE && !\Cookie::get('gdpr_cookie'))
        <div class="cookies-card hide text-center">
            <div class="cookies-card__icon bg--base">
                <i class="las la-cookie-bite text--dark"></i>
            </div>
            <p class="cookies-card__content mt-4">{{ $cookie->data_values->short_desc }} <a class="text--base"
                   href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
            <div class="cookies-card__btn mt-4">
                <a class="btn btn--base w-100 policy" href="javascript:void(0)">@lang('Allow')</a>
            </div>
        </div>
    @endif

    <script src="{{ asset('assets/global/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

    @stack('script-lib')

    @php echo loadExtension('tawk-chat') @endphp

    @include('partials.notify')

    @if (gs('pn'))
        @include('partials.push_script')
    @endif

    @stack('script')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/lightcase.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("click", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).data('lang_code');
            });

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });

            $.each($(".select2"), function() {
                $(this)
                    .wrap(`<div class="position-relative"></div>`)
                    .select2({
                        dropdownParent: $(this).parent(),
                    });
            });


            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

            let elements = document.querySelectorAll('[s-break]');
            Array.from(elements).forEach(element => {
                let html = element.innerHTML;
                if (typeof html != 'string') {
                    return false;
                }
                let breakLength = parseInt(element.getAttribute('s-break'));
                html = html.split(" ");
                var colorText = [];
                if (breakLength < 0) {
                    colorText = html.slice(breakLength);
                } else {
                    colorText = html.slice(0, breakLength);
                }
                let solidText = [];
                html.filter(ele => {
                    if (!colorText.includes(ele)) {
                        solidText.push(ele);
                    }
                });
                var color = element.getAttribute('s-color') || "title-color";
                colorText = `<span class="${color}">${colorText.toString().replaceAll(',', ' ')}</span>`;
                solidText = solidText.toString().replaceAll(',', ' ');
                breakLength < 0 ? element.innerHTML = `${solidText} ${colorText}` : element.innerHTML =
                    `${colorText} ${solidText}`
            });


        })(jQuery);
    </script>
</body>

</html>
