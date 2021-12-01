<?php

use Carbon\CarbonImmutable;
use Ramsey\Uuid\Uuid;

class User
{
    private string $id;
    private UserName $name;
    private Email $email;
    private CarbonImmutable $createdAt;
    private CarbonImmutable $updatedAt;
    private ?CarbonImmutable $deletedAt;

    public function __construct(
        UserName $name,
        Email $email
    )
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->email = $email;
        $this->updatedAt = $this->createdAt = CarbonImmutable::now()->utc();

        // TODO: Dispatch UserCreated event
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function createdAt(): CarbonImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): CarbonImmutable
    {
        return $this->updatedAt;
    }

    public function delete(): void
    {
        $this->deletedAt = $this->updatedAt = CarbonImmutable::now()->utc();

        // TODO: Dispatch UserDeleted event
    }

}