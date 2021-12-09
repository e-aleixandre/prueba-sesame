<?php

namespace App\CoreContext\Application\Query\User;

use App\CoreContext\Domain\Exception\User\UserNotFoundException;
use App\CoreContext\Domain\Model\User\User;
use App\CoreContext\Domain\Model\User\UserRepository;

class FindUsersQueryHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /** @return User[] */
    public function handle(FindUsersQuery $query): array
    {
        // TODO: Return a QueryResponse
        return $this->userRepository->query($query);
    }

}
