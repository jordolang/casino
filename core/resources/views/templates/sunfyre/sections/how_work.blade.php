@php
    $content = getContent('how_work.content', true);
    $howWorks = getContent('how_work.element', orderById: true);
@endphp
<section class="winstep-section py-5">
    <div class="container">
        <div class="winstep-content">
            <div class="section-heading">
                <h1 class="section-heading__title">{{ __(@$content->data_values->heading) }}</h1>
                <p class="section-heading__desc">{{ __(@$content->data_values->subheading) }}</p>
            </div>
            <div class="winstep-wrapper">
                @foreach ($howWorks as $work)
                    <div class="winstep-item">
                        <div class="winstep-item__badge">
                            <span class="count">{{ $loop->iteration }}</span>
                        </div>
                        <div class="winstep-item__content">
                            <div class="winstep-item__icon">
                                <img src="{{ getImage('assets/images/frontend/how_work/' . @$work->data_values->image, '65x65') }}" alt="@lang('image')">
                            </div>
                            <h5 class="winstep-item__title">{{ __(@$work->data_values->title) }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="winstep-slider_dots"></div>
        </div>
    </div>
</section>
