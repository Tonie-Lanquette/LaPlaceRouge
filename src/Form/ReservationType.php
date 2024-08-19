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
            ->add('numberPeople')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('shift', ChoiceType::class,
            [
                'choices'  => [
                    'Midi' => 'Midi',
                    'Soir' => 'Soir',
                ],
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('tables', EntityType::class, [
                'class' => Table::class,
                'choice_label' => 'id',
                'multiple' => true,
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
