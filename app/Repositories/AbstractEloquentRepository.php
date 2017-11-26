<?php
namespace App\Repositories;

use Illuminate\Container\Container;

abstract class AbstractEloquentRepository
{
    protected $model;

    public function __construct(Container $app)
    {
        $this->model = $app->make($this->modelClassName);
    }
}
