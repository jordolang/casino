@php
    $gameContent = getContent('game.content', true);
    $games = \App\Models\Game::active()->get();
@endphp
<section class="games-section pt-100 pb-50">
    <div class="container">
        <div class="games-section-content">
            <div class="section-heading">
                <h1 class="section-heading__title">{{ __(@$gameContent->data_values->heading) }}</h1>
                <p class="section-heading__desc">{{ __(@$gameContent->data_values->subheading) }}</p>
            </div>

            <div class="games-section-wrapper">
                @include($activeTemplate . 'partials.game', ['games' => $games])
            </div>
            @include($activeTemplate . 'partials.referral')
        </div>
    </div>
</section>
