<?php

namespace App\Controller\Admin;

use App\Entity\Panel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PanelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Panel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('description'),
            AssociationField::new('moderateur'),
            AssociationField::new('panelistes'),
            AssociationField::new('conferenciers'),
            AssociationField::new('evenement'),
            DateField::new('date', 'Date du jour'),
        ];
    }
    
}
