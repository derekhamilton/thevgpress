<?php
namespace App\Exceptions;

class CommentNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct(trans('exceptions.CommentNotFoundException'));
    }
}
