<?php

namespace App\Controller\Admin;

use App\Entity\JourEvenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class JourEvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JourEvenement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            DateField::new('date', 'Date du jour'),
            AssociationField::new('evenement', 'Événement'),
        ];
    }
    
}
