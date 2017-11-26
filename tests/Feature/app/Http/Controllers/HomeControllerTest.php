<?php
namespace Tests\App\Http\Controllers;

class HomeControllerTest extends \TestCase
{
    public function testShow()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
