<?php

namespace App\Controller\Admin;

use App\Entity\Invite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class InviteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invite::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom complet'),
            TextField::new('poste'),
            TextEditorField::new('biographie'),

            // Champ pour l'upload dans le formulaire
            TextField::new('imageFile', 'Photo')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            // Champ pour afficher l’image dans l’index
            ImageField::new('photo')
                ->setBasePath('/uploads/invites')
                ->onlyOnIndex(),


            // ImageField::new('photo')
            // ->setUploadDir('public/uploads/invites')  // où le fichier est stocké physiquement
            // ->setBasePath('/uploads/invites') 
        ];
    }
}
