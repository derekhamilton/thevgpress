<?php
namespace App\Http\Middleware;

use App\Alerts\Alert;
use App\Factories\Validation\FormValidatorFactory;
use Closure;

class Validate
{
    private $factory;
    private $alert;


    public function __construct(FormValidatorFactory $factory, Alert $alert)
    {
        $this->factory = $factory;
        $this->alert   = $alert;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        $validator = $this->factory->make($request->route()->getName());
        if (!$validator->validate($request)) {
            foreach ($validator->errors() as $error) {
                $this->alert->error($error);
            }
            return response(json_encode($this->alert->all()));
        }

        return $next($request);
    }
}
