<?php
namespace App\Alerts;

class ReportBag extends \Illuminate\Support\MessageBag
{
    public function delete($key)
    {
        unset($this->messages[$key]);
    }
}
