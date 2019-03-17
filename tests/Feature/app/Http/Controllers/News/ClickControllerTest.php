<?php
namespace Tests\App\Http\Controllers\News;

use App\Models\User;

class ClickControllerTest extends \TestCase
{
    public function testClick()
    {
        $response = $this->actingAs(User::find(1))->json('POST', 'news/click', ['id' => 1]);
        $response->assertStatus(200);
    }
}
