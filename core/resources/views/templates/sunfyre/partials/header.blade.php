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

                    @include($activeTemplate . 'partials.language', ['class' => 'd-xl-none'])

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    @php
                        $pages = App\Models\Page::where('tempname', $activeTemplate)
                            ->where('is_default', Status::NO)
                            ->get();
                    @endphp
                    @foreach ($pages as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link {{ menuActive('pages', [$data->slug]) }}" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('games') }}" href="{{ route('games') }}">@lang('Game')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('blog') }}" href="{{ route('blog') }}">@lang('Blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('contact') }}" href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                    <li class="pt-3 pb-2 d-xl-none">
                        <ul class="flex-align gap-3">
                            @auth
                                <li class="login-registration-list__item">
                                    <a href="{{ route('user.home') }}" class="btn btn--gradient">@lang('Dashboard')</a>
                                </li>
                            @else
                                <li class="login-registration-list__item">
                                    <a href="{{ route('user.login') }}" class="btn btn--gradient">@lang('Login')</a>
                                </li>
                                @if (gs('registration'))
                                    <li class="login-registration-list__item">
                                        <a href="{{ route('user.register') }}" class="btn btn--gradient">@lang('Register')</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="header-right d-none d-xl-block">
                <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                    <ul class="login-registration-list flex-wrap gap-3 align-items-center">
                        @include($activeTemplate . 'partials.language', ['class' => ''])
                        @auth
                            <li class="login-registration-list__item">
                                <a href="{{ route('user.home') }}" class="btn btn--gradient">@lang('Dashboard')</a>
                            </li>
                        @else
                            <li class="login-registration-list__item">
                                <a href="{{ route('user.login') }}" class="btn btn--gradient">@lang('Login')</a>
                            </li>
                            @if (gs('registration'))
                                <li class="login-registration-list__item">
                                    <a href="{{ route('user.register') }}" class="btn btn--gradient">@lang('Register')</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
