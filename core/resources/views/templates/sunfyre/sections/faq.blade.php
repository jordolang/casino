@php
    $content = getContent('faq.content', true);
    $faqs = getContent('faq.element', orderById: true);
@endphp

<section class="faq-section py-50">
    <div class="container">
        <div class="faq-section-content">
            <div class="row gy-5 align-items-end justify-content-between">
                <div class="col-xxl-6 col-lg-6 order-2 order-lg-1">
                    <div class="section-heading style-left">
                        <h1 class="section-heading__title" s-break="-1" s-color="title-color">{{ __(@$content->data_values->heading) }}</h1>
                        <p class="section-heading__desc">{{ __(@$content->data_values->subheading) }}</p>
                    </div>
                    <div class="accordion custom--accordion" id="accordionExample">
                        @foreach ($faqs as $faq)
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <button class="accordion-button @if ($loop->first) collapsed @endif" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="@if ($loop->first) true @else false @endif" aria-controls="collapse{{ $loop->iteration }}">
                                        <span class="accordion-title">{{ __(@$faq->data_values->question) }}</span>
                                        <span class="accordion-icon"><i class="las la-angle-down"></i></span>
                                    </button>
                                </div>
                                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse @if ($loop->first) show @endif"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p class="text">{{ __(@$faq->data_values->answer) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xxl-5 col-lg-6 order-1 order-lg-2">
                    <div class="faq-thumbs">
                        <img src="{{ getImage('assets/images/frontend/faq/' . @$content->data_values->image, '560x565') }}" alt="@lang('image')">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
