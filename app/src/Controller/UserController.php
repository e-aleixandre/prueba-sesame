<?php

namespace App\Controller;

use App\Entity\User;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * Get all users
     *
     * @Route("/user", name="user_index", methods={ "GET" })
     */
    public function index() : Response {
        return new Response("Response");
    }

    /**
     * Get a single user
     */
    public function show() {

    }

    /**
     *
     * @Route("/user", name="user_create", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create() {
        $user = new User();
        $user->setEmail("test@test.com")
            ->setName("John Doe");

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json([
            "ok" => true,
            "data" => [
                "user" => $user
            ]
        ]);
    }
}
