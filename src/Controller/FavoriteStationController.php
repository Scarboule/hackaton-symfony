<?php

namespace App\Controller;

use App\Entity\FavoriteStation;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class FavoriteStationController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/add-favorite', name: 'add_favorite_station')]
    public function add(Request $request, UserRepository $stationRepository, EntityManagerInterface $manager): Response
    {
        $user = $this->security->getUser();
        $stationId = $request->get('station_id');
        $station = $stationRepository->find($stationId);

        $favoriteStation = new FavoriteStation();
        $favoriteStation->setUser($user);
        $favoriteStation->setStation($station);

        $manager->persist($favoriteStation);
        $manager->flush();

        return $this->redirect('/station/' . $stationId);
    }

    #[Route('/delete-favorite', name: 'delete_favorite_station')]
    public function delete(Request $request, UserRepository $stationRepository, EntityManagerInterface $manager): Response
    {
        $user = $this->security->getUser();
        $stationId = $request->get('station_id');
        $station = $stationRepository->find($stationId);

        $favoriteStation = $user->getFavoriteStations()->filter(function ($favorite) use ($station) {
            return $favorite->getStation()->getId() === $station->getId();
        })->first();

        $manager->remove($favoriteStation);
        $manager->flush();

        return $this->redirect('/station/' . $stationId);
    }
}
