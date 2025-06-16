<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Form\ProgrammeImageFormType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Vich\UploaderBundle\Form\Type\VichImageType;


class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('theme', 'Thème'),
            TextField::new('adresse'),
            TextField::new('ville'),
            TextField::new('pays'),
            DateField::new('dateDebut', 'Date de Début'),
            DateField::new('dateFin', 'Date de Fin'),
            TextField::new('lienVideo', 'Lien Vidéo'),
            TextEditorField::new('description'),
            BooleanField::new('actif'),

            CollectionField::new('programmeImages', 'Images du programme')
            ->setEntryType(ProgrammeImageFormType::class)
            ->setFormTypeOptions(['by_reference' => false])
            ->onlyOnForms(),
        ];
    }


    // Création d'un évènement 
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Evenement && $entityInstance->isActif()) {
            $repository = $entityManager->getRepository(Evenement::class);
            $actifs = $repository->findBy(['actif' => true]);

            foreach ($actifs as $e) {
                if ($e !== $entityInstance) {
                    $e->setActif(false);
                    $entityManager->persist($e);
                }
            }
        }

        parent::persistEntity($entityManager, $entityInstance);
    }


    // Modification d'un évènement
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Evenement && $entityInstance->isActif()) {
            $repository = $entityManager->getRepository(Evenement::class);
            $actifs = $repository->findBy(['actif' => true]);

            foreach ($actifs as $e) {
                if ($e !== $entityInstance) {
                    $e->setActif(false);
                    $entityManager->persist($e);
                }
            }
        }

        parent::updateEntity($entityManager, $entityInstance);
    }

    
}
