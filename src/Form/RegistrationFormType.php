<?php

namespace App\Form;

use App\Entity\District;
use App\Entity\Referent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Prénom',
                    'required' => true,
                ]
            )

            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'Nom',
                    'required' => true,
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Votre email',
                    'required' => true,
                ]
            )

            ->add(
                'phone',
                TelType::class,
                [
                    'label' => 'Telephone',
                    'required' => false,
                ]
            )

            ->add(
                'plainPassword',
                PasswordType::class,
                [
                    'label' => 'Mot de passe',
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'validators.user.password.constraint.length.error',
                            // max length allowed by Symfony for security reasons
                            'max' => 255,
                        ]),
                ],
            ])

            ->add(
                'district',
                EntityType::class,
                [
                    'label' => 'Votre Quartier',
                    'class' => District::class,
                    'choice_label' => 'name',
                ]
            )

            ->add(
                'address',
                TextType::class,
                [
                    'label' => 'Adresse',
                    'required' => false,
                ]
            )

            ->add(
                'infos',
                TextareaType::class,
                [
                    'label' => 'Informations complémentaire',
                    'required' => false,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Referent::class,
        ]);
    }
}
