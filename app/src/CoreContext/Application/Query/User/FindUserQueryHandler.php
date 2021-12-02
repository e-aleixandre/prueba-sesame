<?php

namespace App\CoreContext\Application\Query\User;

use App\CoreContext\Domain\Exception\User\UserNotFoundException;
use App\CoreContext\Domain\Model\User\User;
use App\CoreContext\Domain\Model\User\UserRepository;

class FindUserQueryHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(FindUserQuery $query): User
    {
        $user = $this->userRepository->byId($query->userId());

        if (null === $user)
            throw new UserNotFoundException($query->userId());

        // TODO: return a QueryResponse
        return $user;
    }

}
