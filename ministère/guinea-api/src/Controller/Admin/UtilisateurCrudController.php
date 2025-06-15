<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UtilisateurCrudController extends AbstractCrudController
{

    private UtilisateurRepository $repositoy;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UtilisateurRepository $repositoy, UserPasswordHasherInterface $passwordHasher)
    {
        $this->repositoy = $repositoy;
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('password', 'Mot de passe')
                ->setFormTypeOption('attr.type', 'password')->hideOnIndex()
                ->setFormTypeOption('attr.autocomplete', 'off')
                ->hideWhenUpdating(),
            TextField::new('plainPassword', 'Nouveau mot de passe')
                ->setFormTypeOption('attr.type', 'password')
                ->setFormTypeOption('attr.autocomplete', 'new-password')
                ->hideOnIndex()
                ->onlyWhenUpdating()

        ];
    }

    // Fonction pour la création
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->handlePassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }


    // Fonction pour la modification
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->handlePassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    /**
     * Hacher le mot de passe
     */
    private function handlePassword($entityInstance): void
    {
        if (!$entityInstance instanceof Utilisateur) {
            return;
        }

        $plainPassword = $entityInstance->getPassword();

        if (!empty($plainPassword)) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $plainPassword);
            $entityInstance->setPassword($hashedPassword);
        }

        $plainPassword = $entityInstance->getPlainPassword();

        if (!empty($plainPassword)) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $plainPassword);
            $entityInstance->setPassword($hashedPassword);
        }
    }
    
}
