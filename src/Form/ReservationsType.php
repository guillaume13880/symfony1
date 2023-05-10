<?php

namespace App\Form;

use App\Entity\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints as Assert;



class ReservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '180',
                    'placeholder' => 'john.doe@exemple.fr'
                ],
                'label' => 'Adresse e-mail',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 180]),
                    new Assert\Email(),
                    new Assert\NotBlank()
                ]
            ])
            ->add('nbCouvert', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => 'Nombre de couvert(s)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(7)
                ]
            ])
            ->add('date', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Renseigner une date d\'arriver',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'widget' => 'single_text',
            ])
            ->add('heure', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => 'Renseigner une heure d\'arriver',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'placeholder' => '...',
                'choices' => [
                    'Midi' => [
                        '12h00' => '12h00',
                        '12h15' => '12h15',
                        '12h30' => '12h30',
                        '12h45' => '12h45',
                        '13h00' => '13h00',
                        '13h15' => '13h15',
                        '13h30' => '13h30',
                        ],
                    'Soir' => [
                        '19h00' => '19h00',
                        '19h15' => '19h15',
                        '19h30' => '19h30',
                        '19h45' => '19h45',
                        '20h00' => '20h00',
                        '20h15' => '20h15',
                        '20h30' => '20h30',
                        ],
                    ],
                    'constraints' => [
                        new Assert\Length(['min' => 2, 'max' => 6]),
                        new Assert\NotBlank()
                    ]                  
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Reserver !',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
