<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
	public function nav(StationController $userRepository): Response
	{
		$stations = $userRepository;
		
		return $this->render('menu/nav.html.twig', [
			'stations' => $stations,
		]);
	}
}
