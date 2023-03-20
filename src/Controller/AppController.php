<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(UserRepository $userRepository): Response
    {

        $users = array_slice($userRepository->findAll(), 1);

        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
            'stations' => $users,
        ]);
    }
}
