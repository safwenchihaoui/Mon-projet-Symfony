<?php

namespace App\Form;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
           ->add('roles', ChoiceType::class, [
             'choices'  => [
                'User' => "ROLE_USER",
               'Admin' => "ROLE_ADMIN",
               'Auteur'=>"ROLE_AUTEUR",
                                       
                ],
                'required'=> true,
                'multiple' => true,  
                'expanded' => true,
     
            ])
            ->add('auteurs', EntityType::class, array(
                'class' => User::class,
                'expanded'     => true,
                'multiple'     => true,
               
            ))
           // ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('age')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
