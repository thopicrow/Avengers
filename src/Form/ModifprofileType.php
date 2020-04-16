<?php

namespace App\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifprofileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label'=> 'Pseudo',
            ])
            ->add('email', EmailType::class, [
                'label'=> 'E-mail',
            ])
            ->add('nom', TextType::class, [
                'label'=> 'Nom',
            ])

            ->add('prenom', TextType::class, [
                'label'=> 'Prénom',
            ])
            ->add('telephone', TextType::class, [
                'label'=> 'Téléphone',
            ])
            ->add('password', PasswordType::class, [
                'label'=> 'Mot de passe actuel',
            ])
            ->add('password', PasswordType::class, [
                'label'=> 'Nouveau mot de passe',
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModifprofileType::class,
        ]);
    }
}
