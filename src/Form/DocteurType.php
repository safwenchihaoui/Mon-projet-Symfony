<?php

namespace App\Form;

use App\Entity\Docteur;
use App\Entity\Hopital;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('image', FileType::class, [
                'label' => 'image',
                'mapped'=>false,
                'required' =>true,
                
                
         ])
            ->add('designation')
            ->add('chef')
            ->add('Hopital', EntityType::class, [
                'class' => Hopital::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Docteur::class,
        ]);
    }
}
