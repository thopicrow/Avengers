<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('passwordPlain', PasswordType::class, [
                'label'=> 'Mot de passe actuel',
                'required'=>true,
                'mapped'=>false
            ])
            ->add('newPassword', RepeatedType::class, [ 'type'=>PasswordType::class,
                'invalid_message' => 'Les deux mots de passe sont différents',
                'required'=>false,
                'error_bubbling'=>true,
                'first_options'=>['label'=>'Nouveau mot de passe'],
                'second_options'=>['label'=>'Répéter le nouveau mot de passe']
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
