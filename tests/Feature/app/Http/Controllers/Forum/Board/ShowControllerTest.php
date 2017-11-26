<?php
namespace Tests\App\Http\Controllers\Forum\Board;

class ShowControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('forum/gaming-discussion');
        $response->assertStatus(200);
    }
}
