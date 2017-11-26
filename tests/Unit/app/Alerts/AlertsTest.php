<?php
namespace Tests\App\Alerts\Alert;

use App\Alerts\Alert;

class AlertsTest extends \TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testAdd()
    {
        $alert = app(Alert::class);
        $alert->add('apples', 'a');
        $alert->add('oranges', 'x');
        $alert->add('apples', 'b');
        $alert->add('oranges', 'y');
        $alert->add('apples', 'c');
        $alert->add('oranges', 'z');

        $apples = $alert->get('apples');
        $oranges = $alert->get('oranges');

        $this->assertTrue($apples[0] == 'a' && $apples[1] == 'b' && $apples[2] == 'c'
            && $oranges[0] == 'x' && $oranges[1] == 'y' && $oranges[2] == 'z');
    }
}
