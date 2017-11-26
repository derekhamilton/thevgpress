<?php
namespace Tests\App\Http\Controllers\Join;

class ShowControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('join');
        $response->assertStatus(200);
    }
}
