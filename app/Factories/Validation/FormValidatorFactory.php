<?php
namespace App\Factories\Validation;

use App\Contracts\Validation\FormValidator;
use App\Factories\AbstractDriverFactory;

/**
 * @method FormValidator make($driver)
 */
final class FormValidatorFactory extends AbstractDriverFactory
{
    protected $drivers = [
        'news/post' => \App\Validation\FormValidators\NewsItemValidator::class,
    ];
}
