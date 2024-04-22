<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Course;
use App\Entity\Exercise;
use App\Entity\File;
use App\Entity\Origin;
use App\Entity\Skill;
use App\Entity\Thematic;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class Constant{
    public const NIVEAU1 = 'Niveau 1';
    public const NIVEAU2 = 'Niveau 2';
    public const NIVEAU3 = 'Niveau 3';
    public const NIVEAU4 = 'Niveau 4';
    public const NIVEAU5 = 'Niveau 5';
    public const NIVEAU6 = 'Niveau 6';
    public const NIVEAU7 = 'Niveau 7';
    public const NIVEAU8 = 'Niveau 8';
    public const NIVEAU9 = 'Niveau 9';
    public const NIVEAU10 = 'Niveau 10';
    public const NIVEAU11 = 'Niveau 11';
    public const NIVEAU12 = 'Niveau 12';
    public const NIVEAU13 = 'Niveau 13';
    public const NIVEAU14 = 'Niveau 14';
    public const NIVEAU15 = 'Niveau 15';
    public const NIVEAU16 = 'Niveau 16';
    public const NIVEAU17 = 'Niveau 17';
    public const NIVEAU18 = 'Niveau 18';
    public const NIVEAU19 = 'Niveau 19';
    public const NIVEAU20 = 'Niveau 20';
    public const ETUDIANT = 'Etudiant';
    public const ENSEIGNANT = 'Enseignant';
}

class SoumettreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'nom',
                    'placeholder' => 'Nom de l\'exercice',
                ],
                'label' => 'Nom de l\'exercice * :',
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => true,
            ])
            ->add('course_id', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name',
                'label' => 'Matière * :',
                'attr' =>[
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => true,
            ])
            ->add('classroom_id', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name',
                'label' => 'Classe * :',
                'attr' =>[
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => true,
            ])
            ->add('thematic_id', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'name',
                'label' => 'Thématique * :',
                'attr' =>[
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => true,
            ])
            ->add('chapter',TextType::class, [
                'label' => 'Chapitre du cours :',
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'chapitre',
                    'placeholder' => 'Chapitre',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => false,
            ])
            ->add('keywords', TextType::class, [
                'label' => 'Mots clés',
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => false,
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté * :',
                'choices' => [
                    Constant::NIVEAU1 => 1,
                    Constant::NIVEAU2 => 2,
                    Constant::NIVEAU3 => 3,
                    Constant::NIVEAU4 => 4,
                    Constant::NIVEAU5 => 5,
                    Constant::NIVEAU6 => 6,
                    Constant::NIVEAU7 => 7,
                    Constant::NIVEAU8 => 8,
                    Constant::NIVEAU9 => 9,
                    Constant::NIVEAU10 => 10,
                    Constant::NIVEAU11 => 11,
                    Constant::NIVEAU12 => 12,
                    Constant::NIVEAU13 => 13,
                    Constant::NIVEAU14 => 14,
                    Constant::NIVEAU15 => 15,
                    Constant::NIVEAU16 => 16,
                    Constant::NIVEAU17 => 17,
                    Constant::NIVEAU18 => 18,
                    Constant::NIVEAU19 => 19,
                    Constant::NIVEAU20 => 20,
                ],
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'difficulte',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => true,
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Durée (en heure):',
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
            ])
            ->add('origin_id', EntityType::class, [
                'class' => Origin::class,
                'choice_label' => 'name',
                'label' => 'Origine :',
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => false,
            ])
            ->add('origin_name', TextType::class, [
                'label' => 'Nom du livre/Lien du site :',
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => false,
            ])
            ->add('origin_information', TextType::class, [
                'label' => 'Informations complémentaires :',
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'required' => false,
            ])
            ->add('proposed_by_type', ChoiceType::class, [
                'label' => 'Ou proposé par un :',
                'choices' => [
                    Constant::ETUDIANT => Constant::ETUDIANT,
                    Constant::ENSEIGNANT => Constant::ENSEIGNANT,
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
            ])
            ->add('proposed_by_first_name', TextType::class,[
                'label' => 'Nom :',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
            ])
            ->add('proposed_by_last_name', TextType::class,[
                'label' => 'Prénom :',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
            ])
            ->add('exercice_file_id', VichFileType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
                'mapped' => false,
            ])
            ->add('correction_file_id', VichFileType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'form-row',
                ],
            ])
            ->add('created_by_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('skills', EntityType::class, [
                'label' => false,
                'class' => Skill::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('BtnSubmit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                'class' => 'btn',
                ],
            ])
            ->add('BtnContinue', SubmitType::class, [
                'label' => 'Continuer',
                'attr' => [
                'class' => 'btn',
                ],
            ])
            
            ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
