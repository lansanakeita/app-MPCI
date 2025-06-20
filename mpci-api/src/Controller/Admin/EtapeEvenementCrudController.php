<?php

namespace App\Controller\Admin;

use App\Entity\EtapeEvenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class EtapeEvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EtapeEvenement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('titre'),
            TimeField::new('heureDebut', 'Heure de Début'),
            TimeField::new('heureFin', 'Heure de Fin'),
            AssociationField::new('jourEvenement', 'Jour Événement'),
            TextEditorField::new('activites', ' Actités')
        ];
    }
    
}
