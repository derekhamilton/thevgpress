@foreach ($days as $day => $news)
    <div class="day-container">
        <div class="day-title">
            <a href="#">
                {{ $day }}
            </a>
        </div>
        <div class="day-news">
            @foreach ($news as $item)
                <div class="news-item {{ $item->company }} @if ($item->is_big_news) big-news @endif">
                    <div class="news-title">
                        @if (file_exists(config('app.filesPath')."/".parse_url($item->link, PHP_URL_HOST).".ico"))
                            <img class="news-icon" src="" alt="" title="">
                        @endif
                        <a href="{{ $item->link }}">
                            {{ $item->title }}
                        </a>
                    </div>
                    <div class="news-description">{{ $item->description }}</div>
                    <div class="news-tags">
                        {{ parse_url($item->link, PHP_URL_HOST) }}
                        @if ($item->is_news) news @endif
                        @if ($item->is_media) media @endif
                        @if ($item->is_impressions) impressions @endif
                        @if ($item->is_editorial) editorial @endif
                    </div>
                    <div class="news-username text-right">
                        {{ $item->username }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
