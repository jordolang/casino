@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElement = getContent('testimonial.element', orderById: true);
@endphp
<section class="testimonials py-50">
    <div class="container">
        <div class="testimonials-wrapper">
            <div class="row gy-5 align-items-center justify-content-between">
                <div class="col-xxl-6 col-xl-7 col-lg-5">
                    <div class="card-slider testimonials-slider">
                        @foreach ($testimonialElement as $testimonial)
                            <div class="card-item">
                                <div class="card-item__content">
                                    <div class="card-item__image-lg card-item__image">
                                        <img src="{{ getImage('assets/images/frontend/testimonial/' . @$testimonial->data_values->image, '90x80') }}" alt="@lang('image')">
                                    </div>
                                    <h5 class="card-item__title">{{ __(@$testimonial->data_values->name) }}</h5>
                                    <p class="card-item__desc">{{ __(@$testimonial->data_values->quote) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="testimonials-slider-dots"></div>
                </div>
                <div class="col-xxl-5 col-xl-5 col-lg-7">
                    <div class="choose-us-content">
                        <div class="section-heading style-left">
                            <h1 class="section-heading__title" s-break="-1" s-color="title-color">{{ __(@$testimonialContent->data_values->heading) }}</h1>
                            <p class="section-heading__desc">{{ __(@$testimonialContent->data_values->description) }}</p>
                        </div>
                        <a href="{{ url(@$testimonialContent->data_values->button_url) }}" class="btn btn--gradient" tabindex="0">{{ __(@$testimonialContent->data_values->button_name) }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
