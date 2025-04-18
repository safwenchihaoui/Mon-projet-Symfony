<?php

namespace App\Form;

use App\Entity\Recommandation;
use App\Entity\SouscategorieRecommand;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecommandationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('image', FileType::class, [
                'label' => 'image',
                'mapped'=>false,
         ])
                       
             ->add('pdf', FileType::class, array('label' => 'PDF File'))
            ->add('lien')
          
            ->add('SouscategorieRecommand', EntityType::class, [
                'class' => SouscategorieRecommand::class,
                'choice_label' => 'titre',
                'multiple' => false,
            ])
            
                

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' =>  Recommandation::class,
        ]);
    }
    
}
