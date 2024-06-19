<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
#
class UserAccessController extends AbstractController
{
    #[Route('/', name: 'app_user_access')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user_access/index.html.twig', [
            'controller_name' => 'UserAccessController',
            'user' => $user
        ]);
    }
}
