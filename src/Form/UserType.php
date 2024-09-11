<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
        use Symfony\Component\Form\Extension\Core\Type\PasswordType;
        use Symfony\Component\Form\Extension\Core\Type\TextType;
        use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
        use Symfony\Component\Form\Extension\Core\Type\SubmitType;
        use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your email'
                ],
                'label' => 'Email Address'
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true, // checkboxes instead of multi-select
                'label' => 'Roles',
                'attr' => [
                    'class' => 'form-check'
                ]
            ])
            ->add('password', PasswordType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter a new password if you want to change it'
                ],
                'label' => 'Password'
            ])
            ->add('firstName', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your first name'
                ],
                'label' => 'First Name'
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your last name'
                ],
                'label' => 'Last Name'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save changes',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}