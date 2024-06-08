@php
    $content = getContent('blog.content', true);
    $blogs = getContent('blog.element', false, 4, true);
@endphp
<section class="blog py-50">
    <div class="container">
        <div class="blog-content">
            <div class="section-heading">
                <h2 class="section-heading__title">{{ __(@$content->data_values->heading) }}</h2>
                <p class="section-heading__desc">{{ __(@$content->data_values->subheading) }}</p>
            </div>
            <div class="blog-wrapper">
                @include($activeTemplate . 'partials.blog')
            </div>
        </div>
    </div>
</section>
