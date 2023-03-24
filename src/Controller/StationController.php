<?php

namespace App\Controller;

use App\Repository\LiftRepository;
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
        $station = $userRepository->find($id);
        return $this->render('station/index.html.twig', [
            'station' => $station,
            'slopes' => $station->getSlopes(),
            'lifts' => $station->getLifts(),
            'shops' => $station->getShops(),
            'weatherReports' => $station->getWeatherReports(),
        ]);
    }

    #[Route('/station/{id}/{sort}', name: 'category_show_sorted')]
    public function showSorted($id, $sort, UserRepository $userRepository): Response
    {
        $station = $userRepository->find($id);
        $slopes = $station->getSlopes()->toArray();

        if ($sort === 'asc' or $sort === 'desc') {
            usort($slopes, function ($a, $b) {
                $difficulties = ['green', 'blue', 'red', 'black'];
                $aDiffIndex = array_search($a->getDifficulty(), $difficulties);
                $bDiffIndex = array_search($b->getDifficulty(), $difficulties);
                return $aDiffIndex - $bDiffIndex;
            });

            if ($sort == 'desc') $slopes = array_reverse($slopes);
        } else {
            $slopes = array_filter($slopes, function ($slope) use ($sort) {
                return $slope->getDifficulty() === $sort;
            });
        }

        return $this->render('station/index.html.twig', [
            'station' => $station,
            'slopes' => $slopes,
            'lifts' => $station->getLifts(),
        ]);
    }


}

