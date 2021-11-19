<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class UserId extends Constraint{
    public $message = 'The id does not belong to a existent user.';
}