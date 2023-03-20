<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    /*
    #[Route('/station', name: 'station_index')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('station/index.html.twig', [
            'controller_name' => 'StationController',
            'users' => $userRepository->findAll(),
        ]);
    }*/

    #[Route('/station/{id}', name: 'station_index')]
    public function show($id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        return $this->render('station/index.html.twig', [
            'slopes' => $user->getSlopes(),
            'lifts' => $user->getLifts(),

        ]);
    }
}