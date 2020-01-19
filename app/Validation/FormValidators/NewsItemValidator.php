<?php
namespace App\Validation\FormValidators;

use App\Contracts\Validation\FormValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidationFactory;

class NewsItemValidator implements FormValidator
{
    protected $errors = [];

    public function __construct(ValidationFactory $factory)
    {
        $this->factory = $factory;
    }

    public function addErrorMessage(string $message): void
    {
        $this->errors[] = $message;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validate(Request $request): bool
    {
        $rules = [
            'title' => 'required',
            'link'  => 'required'
        ];

        $validator = $this->factory->make($request->all(), $rules);

        if (!$validator->fails()) {
            return true;
        }

        foreach ($validator->errors()->all() as $error) {
            $this->addErrorMessage($error);
        }

        return false;
    }
}
