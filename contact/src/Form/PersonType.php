<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Femme' => false,
                    'Homme' => true,
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'label' => 'Vous êtes un(e) : ',
       
            ])
            ->add('name', TextType::class, [
                'label' => 'Prénom du contact : ',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new NotNull(),
                    ]

            ])
            ->add('familyName', TextType::class, [
                'label' => 'Nom du contact : ',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new NotNull(),
                ]

            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postale :',
//===============================================================================================================================//
                //TODO: revoir les contrainte et l'organisation des adresses afin de pouvoir vérifier la pertinence de celle ci
                //'constraints' => [  
                //], 
//===============================================================================================================================//
                'required' => false,

            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'constraints' => [
                    new Email(),                    
                ],
                'required' => false,

            ])
            ->add('phone', IntegerType::class, [
                'label' => 'Numéro de téléphone :',
                'constraints' => [
                    new Regex([
                        'pattern' => '^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$^',
                    ])
                ],
                'required' => false,

            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'label' => 'Etiquette(s) :',
                'multiple' => true,
                'expanded' => true,
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
