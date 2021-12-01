<?php

use App\CoreContext\Domain\Model\User\UserRepository;

class CreateUserHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(CreateUser $command): void
    {
        $user = new User(
            $command->name(),
            $command->email()
        );

        $this->userRepository->save($user);
    }
}