<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\ValidationErrors;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    /**
     * Get all users
     *
     * @Route("/users", name="user_index", methods={ "GET" })
     * @param UserRepository $userRepository
     *
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
     *
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
     * Creates a new user
     *
     * @Route("/users", name="user_create", methods={"POST"})
     * @param Request $request
     * @param ValidationErrors $validationErrors
     * @param EntityManagerInterface $entityManager
     *
     * @return JsonResponse
     */
    public function create(Request $request, ValidationErrors $validationErrors, EntityManagerInterface $entityManager): JsonResponse
    {
        $violations = $this->validateUser($request->request->all());

        // If there are input errors, parse them and respond
        if ($violations->count())
        {
            return $this->json($validationErrors->parse($violations), 400);
        }

        // No errors, create the new user
        $user = new User();
        $user->setName($request->get('name'))
            ->setEmail($request->get('email'));

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user->getAsArray(), 201);
    }

    /**
     * Update a user
     *
     * @Route("/users/{id}", name="user_update", methods={ "PUT" })
     *
     * @param $id
     * @param Request $request
     * @param UserRepository $userRepository
     * @param ValidationErrors $validationErrors
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function update($id, Request $request, UserRepository $userRepository,ValidationErrors $validationErrors, EntityManagerInterface $entityManager): JsonResponse
    {

        $user = $userRepository->find($id);

        // Throw 404 if no user is found
        if (!$user)
            throw $this->createNotFoundException();

        // Validate the input
        $violations = $this->validateUser($request->request->all());

        if ($violations->count())
        {
            return $this->json($validationErrors->parse($violations), 400);
        }

        // The user exists and the input is correct
        $user->setEmail($request->get('email'))
            ->setName($request->get('name'));

        $entityManager->flush();

        return $this->json($user->getAsArray());
    }

    /**
     * Deletes a user
     *
     * @Route("/users/{id}", name="user_delete", methods={ "DELETE" })
     * @param $id
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     *
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

    /**
     * Helper function to validate User related input
     *
     * @param $data
     * @return ConstraintViolationListInterface
     */
    private function validateUser($data): ConstraintViolationListInterface
    {
        $constraints = new Assert\Collection([
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string'])
            ],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email()
            ]
        ]);

        return $this->validator->validate($data, $constraints);
    }
}
