<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * Get all users
     *
     * @Route("/users", name="user_index", methods={ "GET" })
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function index(UserRepository $userRepository): JsonResponse {
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
     * @param $id
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function show($id, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->find($id);

        if (!$user)
            throw $this->createNotFoundException();

        return $this->json($user->getAsArray());
    }

    /**
     *
     * @Route("/users", name="user_create", methods={"POST"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entityManager
     *
     */
    public function create(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $user = new User();

        $constraints = new Assert\Collection([
            'name' => [
                new Assert\NotBlank()
            ],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email()
            ]
        ]);

        $violations = $validator->validate($request->request->all(), $constraints);

        if ($violations->count())
        {
            $errors = [];

            foreach ($violations as $violation)
                $errors[] = $violation->getMessage();

            // TODO: Add the field name on each error
            return $this->json($errors, 400);
        }

        $user->setName($request->get('name'))
            ->setEmail($request->get('email'));

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user->getAsArray(), 201);
    }

    /**
     * Deletes a user
     *
     * @Route("/users/{id}", name="user_delete", methods={ "DELETE" })
     * @param $id
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function delete($id, UserRepository $userRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $userRepository->find($id);

        if (!$user)
            throw $this->createNotFoundException();

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json($user->getAsArray());
    }
}
