<?php

namespace App\Form;

use App\Entity\Hopital;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HopitalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('tel')
            ->add('image', FileType::class, [
                'label' => 'image',
                'mapped'=>false,
                'required' =>true,
                
         ])
            ->add('fax')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hopital::class,
        ]);
    }
}
