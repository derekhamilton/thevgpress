<?php
namespace Tests\App\Services\Get\News;

use App\Queries\Comments\CurrentNewsComments;
use App\Queries\News\CurrentNewsByClicks;
use App\Queries\News\CurrentNewsByDate;
use App\Services\Get\News\CurrentService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CurrentServiceTest extends \TestCase
{
    public function testGetByClicks()
    {
        $currentNewsComments = mock(CurrentNewsComments::class);
        $currentNewsComments->shouldReceive('query')->once();
        $currentNewsByClicks = mock(CurrentNewsByClicks::class);
        $currentNewsByClicks->shouldReceive('query')->once()->andReturn(collect());
        $currentNewsByDate = mock(CurrentNewsByDate::class);
        $currentNewsByDate->shouldNotReceive('query');
        $request = mock(Request::class);
        $request->shouldReceive('route')->with('order')->andReturn('popularity');

        $service = new CurrentService(
            $currentNewsComments,
            $currentNewsByClicks,
            $currentNewsByDate
        );
        $this->assertInstanceOf(Collection::class, $service->get($request));
    }

    public function testGetByDate()
    {
        $currentNewsComments = mock(CurrentNewsComments::class);
        $currentNewsComments->shouldReceive('query')->once();
        $currentNewsByClicks = mock(CurrentNewsByClicks::class);
        $currentNewsByClicks->shouldNotReceive('query');
        $currentNewsByDate = mock(CurrentNewsByDate::class);
        $currentNewsByDate->shouldReceive('query')->once()->andReturn(collect());
        $request = mock(Request::class);
        $request->shouldReceive('route')->with('order')->andReturn(null);

        $service = new CurrentService(
            $currentNewsComments,
            $currentNewsByClicks,
            $currentNewsByDate
        );
        $this->assertInstanceOf(Collection::class, $service->get($request));
    }
}
