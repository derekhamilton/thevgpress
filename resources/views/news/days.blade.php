@foreach ($days as $day => $news)
    <div class="day-container">
        <div class="day-title">
            <a href="#">
                {{ $day }}
            </a>
        </div>
        <div class="day-news">
            @foreach ($news as $item)
                @include ('news.item', ['item' => $item])
            @endforeach
        </div>
    </div>
@endforeach
