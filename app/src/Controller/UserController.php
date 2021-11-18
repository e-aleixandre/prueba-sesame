<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * Get all users
     *
     * @Route("/users", name="user_index", methods={ "GET" })
     */
    public function index(UserRepository $userRepository) : Response {
        $users = $userRepository->findAll();

        $usersArray = [];

        foreach ($users as $user) {
            $usersArray[] = $user->getAsArray();
        }

        return $this->json($usersArray);
    }

    /**
     * Get a single user
     *
     * @Route("/users/{id}", name="user_show", methods={ "GET" })
     */
    public function show($id, UserRepository $userRepository) {
        $user = $userRepository->find($id);

        if (!$user)
            throw $this->createNotFoundException();

        return $this->json($user->getAsArray());
    }

    /**
     *
     * @Route("/users", name="user_create", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(EntityManagerInterface $entityManager) {
        $user = new User();
        $user->setEmail("test@test.com")
            ->setName("John Doe");

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            "ok" => true,
            "data" => [
                "user" => $user
            ]
        ]);
    }
}
