<?php
namespace Tests\App\Http\Controllers\News;

class CurrentControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('news');
        $response->assertStatus(200);
    }
}
