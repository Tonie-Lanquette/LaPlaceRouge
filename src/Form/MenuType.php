<?php

namespace App\Form;

use App\Entity\Dishies;
use App\Entity\Menu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
            'label' => 'Nom :'
        ])
            ->add('price', null, [
            'label' => 'Prix :'
        ])
            ->add('dishies', EntityType::class, [
                'class' => Dishies::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
                'label' => 'Plats :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
