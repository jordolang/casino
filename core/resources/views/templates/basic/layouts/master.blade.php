@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.user_header')

    @if (!request()->routeIs('home'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif

    @yield('content')

    @include($activeTemplate . 'partials.footer')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click touchstart', function(e) {
                $('.win-loss-popup').removeClass('active');
            });

            function formatState(state) {
                if (!state.id) return state.text;
                let gatewayData = $(state.element).data();
                return $(`<div class="d-flex gap-2">${gatewayData.imageSrc ? `<div class="select2-image-wrapper"><img class="select2-image" src="${gatewayData.imageSrc}"></div>` : '' }<div class="select2-content"> <p class="select2-title">${gatewayData.title}</p><p class="select2-subtitle">${gatewayData.subtitle}</p></div></div>`);
            }

            $('.select2').each(function(index, element) {
                $(element).select2({
                    templateResult: formatState,
                    minimumResultsForSearch: "-1"
                });
            });

            $('.select2-searchable').each(function(index, element) {
                $(element).select2({
                    templateResult: formatState,
                    minimumResultsForSearch: "1"
                });
            });


            $('.select2-basic').each(function(index, element) {
                $(element).select2({
                    dropdownParent: $(element).closest('.select2-parent')
                });
            });
        })(jQuery)
    </script>
@endpush
