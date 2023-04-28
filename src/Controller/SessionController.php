<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
class SessionController extends AbstractController
{
    #[Route('/', name: 'register')]
    public function register(EntityManagerInterface $manager, Request $request, UserPasswordHasherInterface $passwordHasher )
    {

        $user = new User();

        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){

            /*$user->setMdp(
               $passwordHasher->hashPassword(
                    $user, $form->get('mdp')->getData()));*/
            $mdp=$user->getMdp();
            $hashedPassword = $passwordHasher->hashPassword($user,$mdp);
            $user->setMdp($hashedPassword);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->renderForm('session/index.html.twig', [
            'form'=>$form
        ]);
    }

}
