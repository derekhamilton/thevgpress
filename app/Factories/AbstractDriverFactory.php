<?php
namespace App\Factories;

use Illuminate\Contracts\Foundation\Application;
use App\Exceptions\Factories\UnknownDriverException;

abstract class AbstractDriverFactory
{
    protected $app;
    protected $drivers = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function make(string $driver)
    {
        if (!isset($this->drivers[$driver])) {
            throw new UnknownDriverException($driver);
        }

        return $this->app->make($this->drivers[$driver]);
    }
}
