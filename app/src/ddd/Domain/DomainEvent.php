<?php

namespace App\ddd\Domain;

interface DomainEvent
{
    /**
     * @return \DateTime
     */
    public function occurredOn();
}
