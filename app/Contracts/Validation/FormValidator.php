<?php
namespace App\Contracts\Validation;

use Illuminate\Http\Request;

interface FormValidator
{
    public function validate(Request $request): bool;
    public function errors(): array;
}
