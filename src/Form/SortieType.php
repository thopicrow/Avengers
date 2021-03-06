<?php

namespace App\Form;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie',
            ])
            ->add('dateHeureDebut',  DateTimeType::class, [
                'label' => 'Date et heure de la sortie',
                'widget'=>'choice',
                'years'=>range(date('Y'), date('Y')+10),
            ])
            ->add('dateLimiteInscription', DateType::class, [
                'label' => 'Date limite d\'inscription',
                'years'=>range(date('Y'), date('Y')+10),
            ])
            ->add('nbInscriptionMax', IntegerType::class, [
                'label' => 'Nombre de places',
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée en (min)',
            ])
            ->add('infosSortie', TextareaType::class, [
                'label' => 'Description et infos',
            ])
            ->add('lieu', EntityType::class, [
                'label' => 'Lieu',
                'class' => Lieu::class,
                'choice_label' => 'Nom',
                'placeholder'=>'Choisissez un lieu',
                'choice_value'=>function(?Lieu $entity) {
                    return $entity ? $entity->getId() : '';
                }

            ])
            ->add('annuler', TextType::class,[
                'label'=>'Raison de l\'annulation',
                'required'=>false,
                'attr'=>[
                    'name'=>'annuler',
                    'id'=>'annuler',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
