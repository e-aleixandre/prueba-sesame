<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * Get all users
     *
     * @Route("/user", name="user_index")
     */
    public function index() : Response {
        return new Response("Response");
    }

    /**
     * Get a single user
     */
    public function show() {

    }
}
