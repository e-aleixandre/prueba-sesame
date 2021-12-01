<?php

namespace App\ddd\Domain\Exception;

use RuntimeException;
use Throwable;

abstract class DomainException extends RuntimeException
{
    public static function fromArray(array $data): self
    {
        try {
            $message = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new static();
        }

        return new static($message);
    }
}