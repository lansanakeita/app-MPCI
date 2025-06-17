<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Entity\Invite;
use App\Entity\Panel;
use App\Entity\Participant;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/mpci-administrateur', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{


    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/assets/images/logo.jpg" alt="Logo" style="height:70px;">');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Evenements', 'fas fa-chalkboard', Evenement::class);       
        yield MenuItem::linkToCrud('Invités', 'fas fa-user', Invite::class);
        yield MenuItem::linkToCrud('Participants', 'fas fa-user', Participant::class);
        yield MenuItem::linkToCrud('Panels', 'fas fa-list', Panel::class);
        yield MenuItem::linkToCrud('utilisateurs', 'fas fa-user', Utilisateur::class);
    }
}
