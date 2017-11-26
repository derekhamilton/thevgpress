<?php
namespace Tests\App\Http\Controllers\Login;

class ShowControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('login');
        $response->assertStatus(200);
    }
}
