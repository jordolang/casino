@foreach ($games as $game)
    <div class="game-item">
        <a href="{{ route('user.play.game', $game->alias) }}" class="game-item__image">
            <img src="{{ getImage(getFilePath('game') . '/' . $game->image, getFileSize('game')) }}" alt="@lang('image')">
            <div class="game-item__play">
                <span class="icon"><i class="fas fa-play"></i></span>
            </div>
        </a>
        <h4 class="game-item__title">{{ __($game->name) }}</h4>
    </div>
@endforeach
