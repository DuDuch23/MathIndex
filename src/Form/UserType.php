<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\RoleEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Unique;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 10,
                        'max' => 255,
                        'minMessage' => 'L\'email doit contenir {{ limit }} caractères au minimum.',
                        'maxMessage' => 'L\'email ne doit pas excéder {{ limit }} caractères.',
                    ]),
                    new Email([
                        'message' => 'L\'email n\'est pas valide',
                    ])
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom :',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le nom doit contenir {{ limit }} caractères au minimum.',
                        'maxMessage' => 'Le nom ne doit pas excéder {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres.',
                    ]),
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le prénom doit contenir {{ limit }} caractères au minimum.',
                        'maxMessage' => 'Le prénom ne doit pas excéder {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le prénom ne doit contenir que des lettres.',
                    ]),
                ],
            ])
            ->add('role', ChoiceType::class, [
                'label' => 'Rôle',
                'attr' => [
                    'class' => 'role form-control',
                ],
                'required' => true,
                'row_attr' => [
                    'class' => 'form-group mb-4',
                ],
                'choices' => [
                    'Etudiant' => RoleEnum::STUDENT,
                    'Enseignant' => RoleEnum::TEACHER,
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le mot de passe doit contenir {{ limit }} caractères au minimum.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
