<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Table;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberPeople', null, [
            'label' => 'Nombre de personnes :'
            ])
            ->add('date', null, [
                'widget' => 'single_text',
                'label' => 'Date :'
            ])
            ->add('shift', ChoiceType::class,
            [
                'choices'  => [
                    'Midi' => 'Midi',
                    'Soir' => 'Soir',
                ],
                'label' => 'Service :'
            ])
            ->add('firstname', null, [
                'label' => 'Prénom :'
            ])
            ->add('lastname', null, [
                'label' => 'Nom de famille :'
            ])
            ->add('email', null, [
                'label' => 'Email :'
            ])
            ->add('tables', EntityType::class, [
                'class' => Table::class,
                'choice_label' => 'id',
                'multiple' => true,
                'label' => 'Tables :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
