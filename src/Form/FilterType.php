<?php

namespace App\Form;

use App\Entity\Filter;
use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('site', EntityType::class, [
                'label' => 'Site',
                'class' => Site::class,
                'choice_label' => 'nom'
            ])
            ->add('keyword', TextType::class, [
                'label' => 'Le nom de la sortie contient'
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Entre',
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'Et',
            ])
            ->add('organisateur', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
            ])
            ->add('inscrit', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
            ])
            ->add('nonInscrit', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
            ])
            ->add('past', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'date_class' => Filter::class,
        ]);
    }
}
