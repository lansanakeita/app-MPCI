<?php

namespace App\Form;

use App\Entity\evenement;
use App\Entity\ProgrammeImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProgrammeImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('image')
            // ->add('updatedAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('evenement', EntityType::class, [
            //     'class' => evenement::class,
            //     'choice_label' => 'id',
            // ])

            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'Image du programme',
                'allow_delete' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProgrammeImage::class,
        ]);
    }
}
