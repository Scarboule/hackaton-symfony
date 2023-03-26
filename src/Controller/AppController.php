<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AppController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_index')]
    public function index(UserRepository $userRepository): Response
    {
        $favoriteStations = [];
        if ($this->security->getUser()) {
            $favoriteStations = $this->security->getUser()->getFavoriteStations();
        }

        return $this->render('app/index.html.twig', [
            'stations' => $userRepository->createQueryBuilder('user')
                ->where('user.roles LIKE :role')
                ->setParameter('role', '%ROLE_ADMIN%')
                ->getQuery()
                ->getResult(),
            'favorite_stations' => $favoriteStations,
        ]);
    }
}
