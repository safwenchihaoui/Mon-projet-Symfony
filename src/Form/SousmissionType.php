<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Evennement;
use App\Entity\Sousmission;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SousmissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('theme', ChoiceType::class, [
                'choices' => [
                    'Spondyloarthrites' => 'Spondyloarthrites',
                    'Maladies auto-immunes et vascularites' => 'Maladies auto-immunes et vascularites',
                    'Pathologies microcristallines' => 'Pathologies microcristallines',
                    'Infections ostéo-articulaires' => 'Infections ostéo-articulaires',
                    'Pathologies rachidiennes' => 'Pathologies rachidiennes',
                    'Pathologies musculo-tendino-ligamentaires' => 'Pathologies musculo-tendino-ligamentaires',
                ],
                
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Résumé',
                'required' => false,
                'attr' => [
                    'placeholder' => "Le résumé de l'abstract doit comporter :\n- Introduction ou objectifs\n- Méthodes\n- Résultats\n- Conclusions",
                    'rows' => 6,
                    'class' => 'form-control',
                ],
            ])
            
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('nom_auteur_correspond')
            ->add('prenom_auteur_correspond')
            ->add('email_auteur_correspond', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email',
                    ]),
                    new Email([
                        'message' => 'L’adresse "{{ value }}" n’est pas une adresse email valide.',
                        'mode' => Email::VALIDATION_MODE_STRICT,
                    ])
                ],
            ])
            
            ->add('fichier', FileType::class, array(
                // 'data_class' => null,
                'label' => 'fichier',
                'mapped'=>false,
                'required' =>true,
                ))
            ->add('Evennement', EntityType::class, [
                'class' => Evennement::class,
                'choice_label' => 'titre',
            ])
            ->add('auteurs', CollectionType::class, [
                'entry_type' => AuteurType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'prototype' => true,
                
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sousmission::class,
        ]);
    }
}
