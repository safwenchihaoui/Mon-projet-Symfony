<?php

namespace App\Form;

use App\Entity\CategorieRecommand;
use App\Entity\SouscategorieRecommand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SouscategorieRecommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
           
            ->add('CategorieRecommand', EntityType::class, [
                'class' => CategorieRecommand::class,
                'choice_label' => 'titre',
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => SouscategorieRecommand::class
        ]);
    }
  
}
