<?php
namespace Tests\App\Http\Controllers\Forum\Topic;

class ShowControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('/forum/gaming-discussion/testing');
        $response->assertStatus(200);
        $response->assertSeeText('This is a comment');
    }
}
