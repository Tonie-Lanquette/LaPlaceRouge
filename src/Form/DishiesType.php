<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Dishies;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', null, [
                'label' => 'Prix :'
            ])
            ->add('title', null, [
                'label' => 'Nom :'
            ])
            ->add('description', null, [
                'label' => 'Description :'
            ])
            ->add('picture', null, [
                'label' => 'Image :'
            ])
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                'label' => 'Catégories :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dishies::class,
        ]);
    }
}