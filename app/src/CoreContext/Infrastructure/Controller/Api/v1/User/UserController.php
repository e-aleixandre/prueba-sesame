<?php

namespace App\CoreContext\Infrastructure\Controller\Api\v1\User;

use App\CoreContext\Application\Command\User\CreateUser;
use App\CoreContext\Application\Command\User\CreateUserHandler;
use App\CoreContext\Application\Command\User\DeleteUser;
use App\CoreContext\Application\Command\User\DeleteUserHandler;
use App\CoreContext\Application\Command\User\UpdateUser;
use App\CoreContext\Application\Command\User\UpdateUserHandler;
use App\CoreContext\Application\Query\User\FindUserQuery;
use App\CoreContext\Application\Query\User\FindUserQueryHandler;
use App\CoreContext\Application\Query\User\FindUsersQuery;
use App\CoreContext\Application\Query\User\FindUsersQueryHandler;
use App\CoreContext\Infrastructure\Validator\Application\Command\User\CreateUserValidator;
use App\CoreContext\Infrastructure\Validator\Application\Command\User\UpdateUserValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @Route("/users", methods={"GET"}) */
    public function index(FindUsersQueryHandler $queryHandler)
    {
        $users = $queryHandler->handle(new FindUsersQuery());
        $usersArray = [];
        // TODO: Convert to JSON through a parser
        foreach ($users as $user)
            $usersArray[] = [
                "id" => $user->id(),
                "name" => $user->name(),
                "email" => $user->email(),
                "createdAt" => $user->createdAt(),
                "updatedAt" => $user->updatedAt()
            ];

        return $this->json($usersArray);
    }

    /** @Route("/users/{userId}", methods={"GET"}) */
    public function show(string $userId, FindUserQueryHandler $queryHandler): JsonResponse
    {
        $user = $queryHandler->handle(
            new FindUserQuery($userId)
        );

        return $this->json([
                "id" => $user->id(),
                "name" => $user->name(),
                "email" => $user->email(),
                "createdAt" => $user->createdAt(),
                "updatedAt" => $user->updatedAt()
        ]);
    }

    /** @Route("/users", methods={"POST"}) */
    public function create(Request $request, CreateUserHandler $userHandler, CreateUserValidator $createUserValidator): JsonResponse
    {
        $params = $request->request->all();

        $createUserValidator->validate($params);

        $command = new CreateUser(
            $params["name"],
            $params["email"]
        );

        $userHandler->handle($command);

        return $this->json(null, 201);
    }

    /** @Route("/users/{userId}", methods={"PUT"}) */
    public function update(string $userId, Request $request, UpdateUserHandler $userHandler, FindUserQueryHandler $userQueryHandler, UpdateUserValidator $updateUserValidator): JsonResponse
    {
        $params = $request->request->all();

        $updateUserValidator->validate($params);

        $command = new UpdateUser(
            $userId,
            $params["name"],
            $params["email"]
        );

        $userHandler->handle($command);

        // TODO: Find a better way to pass $userQueryHandler
        return $this->show($command->id(), $userQueryHandler);
    }

    /** @Route("/users/{userId}", methods={"DELETE"}) */
    public function delete(string $userId, DeleteUserHandler $userHandler)
    {
        $command = new DeleteUser(
            $userId
        );

        $userHandler->handle($command);

        return $this->json(null);
    }
}