<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecutityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('secutity/login.html.twig', [

        ]);
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {

    }
}
