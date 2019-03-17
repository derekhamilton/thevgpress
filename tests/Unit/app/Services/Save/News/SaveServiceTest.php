<?php
namespace Tests\App\Services\Save\News;

use App\Models\News;
use App\Models\User;
use App\Queries\News\SaveNews;
use App\Services\Save\News\SaveService;
use Illuminate\Http\Request;
use Mockery;

class SaveServiceTest extends \TestCase
{
    public function testSave()
    {
        $request = mock(Request::class);
        $request->shouldReceive('all')->andReturn([]);
        $request->shouldReceive('input')->with('id')->andReturn(null);

        $news = mock(News::class);
        $news->shouldReceive('getAttribute')->with('user')->andReturn(new User);
        $news->shouldReceive('setAttribute')->with('username', Mockery::any())->once();
        $saveNews = mock(SaveNews::class);
        $saveNews->shouldReceive('query')->once()->andReturn($news);;

        $service = new SaveService($saveNews);
        $service->save($request);
    }
}
