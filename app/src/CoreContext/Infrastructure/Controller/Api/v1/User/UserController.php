<?php

namespace App\CoreContext\Infrastructure\Controller\Api\v1\User;

use App\CoreContext\Application\Command\User\CreateUser;
use App\CoreContext\Application\Command\User\CreateUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @Route("/users/{userId}", methods={"GET"}) */
    public function show(string $userId): JsonResponse
    {
        // TODO: Find the user
        return $this->json([]);
    }

    /** @Route("/users", methods={"POST"}) */
    public function create(Request $request, CreateUserHandler $userHandler): JsonResponse
    {
        // TODO: Validate with CreateUserValidator
        $validatedContent = $request->request->all();

        $command = new CreateUser(
            $validatedContent["name"],
            $validatedContent["email"]
        );

        $userHandler->handle($command);

        return $this->json(["ok" => true]);
    }
}