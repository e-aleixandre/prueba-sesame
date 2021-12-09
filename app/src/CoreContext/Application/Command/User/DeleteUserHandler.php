<?php

namespace App\CoreContext\Application\Command\User;

use App\CoreContext\Domain\Exception\User\UserNotFoundException;
use App\CoreContext\Domain\Model\User\UserRepository;

class DeleteUserHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(DeleteUser $command): void
    {
        $user = $this->userRepository->byId($command->id());

        if (null === $user)
            throw new UserNotFoundException($command->id());

        $user->delete();

        $this->userRepository->save($user);
    }
}