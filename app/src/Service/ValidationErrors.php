<?php

namespace App\Service;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class ValidationErrors
{
    private PropertyAccessor $propertyAccessor;

    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function parse($violations): array
    {
        $errors = [];

        foreach ($violations as $violation)
        {
            $entryErrors = (array) $this->propertyAccessor->getValue($errors, $violation->getPropertyPath());
            $entryErrors[] = $violation->getMessage();
            $this->propertyAccessor->setValue($errors, $violation->getPropertyPath(), $entryErrors);
        }

        return $errors;
    }
}
