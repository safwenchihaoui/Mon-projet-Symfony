<?php

namespace App\Form;

use App\Entity\Outil;
use App\Entity\souscategorieOutil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('lien')
            ->add('pdf', FileType::class, array('label' => 'PDF File'))
            ->add('image', FileType::class, [
                'label' => 'image',
                'mapped'=>false,
                'required' =>true,
                
                
         ])
            ->add('souscategorieOutil', EntityType::class, [
                'class' => souscategorieOutil::class,
                'choice_label' => 'titre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outil::class,
        ]);
    }
}
