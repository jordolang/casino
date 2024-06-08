<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-xl">
            <a class="navbar-brand logo" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="@lang('image')"></a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="collapse justify-content-center navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu align-items-xl-center">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                    </li>

                    <li class="nav-item menu_has_children">
                        <a href="#" class="nav-link">@lang('Deposit')</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('user.deposit.index') }}">@lang('Deposit Now')</a></li>
                            <li><a href="{{ route('user.deposit.history') }}">@lang('Deposit Log')</a></li>
                        </ul>
                    </li>
                    <li class="menu_has_children nav-item">
                        <a href="#" class="nav-link">@lang('Withdraw')</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('user.withdraw') }}">@lang('Withdraw Now')</a></li>
                            <li><a href="{{ route('user.withdraw.history') }}">@lang('Withdraw Log')</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.referrals') }}">@lang('Referrals')</a>
                    </li>
                    <li class="menu_has_children nav-item">
                        <a href="#" class="nav-link">@lang('Reports')</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('user.game.log') }}">@lang('Game Log')</a></li>
                            <li><a href="{{ route('user.commission.log') }}">@lang('Commission Log')</a></li>
                            <li><a href="{{ route('user.transactions') }}">@lang('Transactions')</a></li>
                        </ul>
                    </li>
                    <li class="menu_has_children nav-item">
                        <a href="#" class="nav-link">@lang('Support')</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('ticket.open') }}">@lang('Open New Ticket')</a></li>
                            <li><a href="{{ route('ticket.index') }}">@lang('My Tickets')</a></li>
                        </ul>
                    </li>
                    <li class="menu_has_children nav-item">
                        <a href="#" class="nav-link">@lang('Account')</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('user.profile.setting') }}">@lang('Profile Setting')</a></li>
                            <li><a href="{{ route('user.change.password') }}">@lang('Change Password')</a></li>
                            <li><a href="{{ route('user.twofactor') }}">@lang('2FA Security')</a></li>
                        </ul>
                    </li>
                    <li class="pt-3 pb-2 d-xl-none">
                        <ul class="flex-align gap-3">
                            <li class="login-registration-list__item">
                                <a href="{{ route('user.logout') }}" class="btn btn--gradient">@lang('Logout')</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="header-right d-none d-xl-block">
                <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                    <ul class="login-registration-list flex-wrap gap-3 align-items-center">
                        <li class="login-registration-list__item">
                            <a href="{{ route('user.logout') }}" class="btn btn--gradient">@lang('Logout')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

@push('script')
    <script>
        // mobile menu js
        $(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
            const element = $(this).parent("li");
            if (element.hasClass("open")) {
                element.removeClass("open");
                element.find("li").removeClass("open");
            } else {
                element.addClass("open");
                element.siblings("li").removeClass("open");
                element.siblings("li").find("li").removeClass("open");
            }
        });
    </script>
@endpush
