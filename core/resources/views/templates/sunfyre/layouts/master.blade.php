@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.user_header')

    @if (!request()->routeIs('home'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif

    <section class="py-100">
        <div class="container">
            @yield('content')
        </div>
    </section>


    @include($activeTemplate . 'partials.footer')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click touchstart', function(e) {
                $('.win-loss-popup').removeClass('active');
            });
        })(jQuery)
    </script>
@endpush
