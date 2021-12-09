<?php

namespace App\CoreContext\Infrastructure\Constraints;

use Symfony\Component\Validator\Constraint;

class UserId extends Constraint
{
    public $message = 'The id does not belong to an existent user.';
}
