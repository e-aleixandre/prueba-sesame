<?php

namespace App\ddd\Domain\Exception;

class ValueObjectException extends DomainException
{
    public function setMessage($message): self
    {
        $this->message = $message;
        return $this;
    }
}