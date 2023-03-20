<?php

namespace App\Controller\Admin;

use App\Entity\Lift;
use App\Entity\LiftType;
use App\Entity\Slope;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(SlopeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hackaton Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Account', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Pistes', 'fa fa-person-skiing', Slope::class);
        yield MenuItem::linkToCrud('Remontée mécanique', 'fa fa-elevator', Lift::class);
        if (in_array('ROLE_SUPER_ADMIN', $this->getUser()->getRoles())) {
            yield MenuItem::linkToCrud('Types de pistes', 'fa fa-shapes', LiftType::class);
        }
    }
}
