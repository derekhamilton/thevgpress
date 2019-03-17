<?php
namespace Tests\App\Services\Save\Comments;

use App\Queries\Comments\SaveComment;
use App\Services\Save\Comments\SaveService;
use Illuminate\Http\Request;

class SaveServiceTest extends \TestCase
{
    public function testSave()
    {
        $request = mock(Request::class);
        $request->shouldReceive('input')->with('forumTopicId')->andReturn(1);
        $request->shouldReceive('input')->with('comment')->andReturn('comment');
        $request->shouldReceive('input')->with('id')->andReturn(null);

        $saveComment = mock(SaveComment::class);
        $saveComment->shouldReceive('query')->once();

        $service = new SaveService($saveComment);
        $service->save($request);
    }
}
