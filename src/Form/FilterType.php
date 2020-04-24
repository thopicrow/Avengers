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
                'choice_label' => 'nom',
                'placeholder'=>'Choisissez un site',
                'required'=>false
            ])
            ->add('keyword', TextType::class, [
                'label' => 'Le nom de la sortie contient',
                'required'=>false,
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Entre',
                'required'=>false,
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                    'hour' => 'HH', 'minute' => 'min']
//                'data'=> new \DateTime('now'),
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'Et',
                'required'=>false,
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                    'hour' => 'HH', 'minute' => 'min']
            ])
            ->add('organisateur', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
                'required'=>false,
            ])
            ->add('inscrit', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
                'required'=>false,
            ])
            ->add('nonInscrit', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
                'required'=>false,
            ])
            ->add('past', CheckboxType::class, [
                'attr' => ['class' => 'filled-in'],
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'date_class' => Filter::class,
            'attr'=>[
                'class'=>'hide-on-small-only form-filter',

            ]

        ]);
    }
}
