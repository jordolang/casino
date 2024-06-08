@php
    $breadcrumb = getContent('breadcrumb.content', true);
@endphp

<section class="breadcrumb">
    <div class="breadcrumb__overlay">
        <img src="{{ getImage('assets/images/frontend/breadcrumb/' . @$breadcrumb->data_values->image, '1920x445') }}" alt="overlay-image">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb__wrapper">
                    <h1 class="breadcrumb__title"> {{ __($pageTitle) }}</h1>
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item"><a href="{{ route('home') }}" class="breadcrumb__link">@lang('Home')</a> </li>
                        <li class="breadcrumb__item">/</li>
                        <li class="breadcrumb__item"> <span class="breadcrumb__item-text">{{ __($pageTitle) }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
