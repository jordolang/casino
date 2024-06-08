@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <section class="blog py-100">
        <div class="container">
            <div class="blog-wrapper">
                @include($activeTemplate . 'partials.blog')
            </div>
            {{ paginateLinks($blogs) }}
        </div>
    </section>

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif

@endsection
