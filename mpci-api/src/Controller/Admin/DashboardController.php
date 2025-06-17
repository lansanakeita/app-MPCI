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
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;




#[AdminDashboard(routePath: '/mpci-administrateur', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;


    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(EvenementCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<img src="/assets/images/logo.jpg" alt="Logo" style="height:70px;">');

            //->setTitle('Guinea Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Evenements', 'fas fa-chalkboard', Evenement::class);       
        yield MenuItem::linkToCrud('Invités', 'fas fa-user', Invite::class);
        yield MenuItem::linkToCrud('Participants', 'fas fa-user', Participant::class);
        yield MenuItem::linkToCrud('Panels', 'fas fa-list', Panel::class);
        yield MenuItem::linkToCrud('utilisateurs', 'fas fa-user', Utilisateur::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('assets/styles/app.css');
    }
}
