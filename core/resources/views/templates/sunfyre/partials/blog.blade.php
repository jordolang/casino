@foreach ($blogs as $blog)
    <div class="blog-item">
        <div class="blog-item__thumb">
            <img class="fit-image" src="{{ getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '505x250') }}" alt="blog-image">
        </div>
        <div class="blog-item__readmore">
            <div class="readmore-button">
                <a href="{{ route('blog.details', $blog->slug) }}" class="btn btn--gradient">@lang('Readmore')</a>
            </div>
        </div>
        <div class="blog-item__content">
            <h4 class="blog-item__title">{{ __(@$blog->data_values->title) }}</h4>
            <p class="blog-item__date">{{ @$blog->created_at->format('d M, Y') }}</p>
        </div>
    </div>
@endforeach
