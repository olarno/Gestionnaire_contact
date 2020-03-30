<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'label' => 'Civilité :',
                'choices' => [
                    'Monsieur' => 'mr',
                    'Madame' => 'me',
                    'Mademoiselle' => 'mlle'
                ],
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('name', TextType::class, [
                'label' =>'Prénom :',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('familyName', TextType::class, [
                'label' => 'Nom :',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postal :',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'required' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Numéro de téléphone :',
                'required' => false,
            ])
            ->add('affiliation', TextType::class, [
                'label' => 'Entreprise :',
                'required' => false,
            ])
            ->add('tags', EntityType::class, [
                'label' => 'Fait parti de :',
                'class' => Tag::class,
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
