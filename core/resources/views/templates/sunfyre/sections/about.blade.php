@php
    $content = getContent('about.content', true);
    $abouts = getContent('about.element', orderById: true);
@endphp

<section class="about-section py-50">
    <div class="container">
        <div class="about-section-content">
            <div class="about-section__shape">
                <img src="{{ getImage($activeTemplateTrue . 'images/shapes/about-top-shape.png') }}" alt="@lang('image')">
            </div>

            <div class="row gy-5 align-items-center justify-content-between">
                <div class="col-lg-5 col-xl-6">
                    <div class="about-thumb">
                        <img class="fit-image" src="{{ getImage('assets/images/frontend/about/' . @$content->data_values->image, '485x510') }}" alt="@lang('image')">
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6">
                    <div class="section-heading style-left">
                        <h1 class="section-heading__title">{{ __(@$content->data_values->heading) }}</h1>
                        <p class="section-heading__desc">{{ __(@$content->data_values->description) }}</p>
                    </div>
                    <div class="about-card-wrapper">
                        @foreach ($abouts as $about)
                            <div class="about-card">
                                <div class="about-card__icon">
                                    @php
                                        echo @$about->data_values->icon;
                                    @endphp
                                </div>
                                <h5 class="about-card__title">{{ __(@$about->data_values->title) }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
