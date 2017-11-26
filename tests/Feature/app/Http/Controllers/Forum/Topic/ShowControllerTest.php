<?php
namespace Tests\App\Http\Controllers\Forum\Topi;

class ShowControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('forum/gaming-discussion/testing');
        $response->assertStatus(200);
    }
}
