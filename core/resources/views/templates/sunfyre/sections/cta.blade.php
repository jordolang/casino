@php
    $content = getContent('cta.content', true);
@endphp

<div class="call-section py-50">
    <div class="container">
        <div class="call-section-content">
            <div class="call-section__wrapper">
                <div class="call-section__left">
                    <div class="section-heading style-left">
                        <h2 class="section-heading__title">{{ __(@$content->data_values->heading) }}
                        </h2>
                        <p class="section-heading__desc">{{ __(@$content->data_values->subheading) }}</p>
                    </div>

                    <a href="{{ url(@$content->data_values->button_url) }}" class="btn btn--gradient" tabindex="0">{{ __(@$content->data_values->button) }}</a>
                </div>
                <div class="call-section__thumb">
                    <img src="{{ getImage('assets/images/frontend/cta/' . @$content->data_values->image, '340x325') }}" alt="@lang('image')">
                </div>
            </div>
        </div>
    </div>
</div>
