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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
                'choice_label' => 'matiere',
                'label' => 'Matière * :',
                'class' => 'App\Entity\Course',
                'attr' =>[
                    'class' => 'course',
                ],
                'required' => true,

            ])
            ->add('classroom_id', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'id',
                'label' => 'Classe * :',
                'class' => 'App\Entity\Classroom',
                'attr' =>[
                    'class' => 'classroom'
                ],
                'required' => true,
            ])
            ->add('thematic_id', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'id',
                'label' => 'Thématique * :',
                'class' => 'App\Entity\Thematic',
                'attr' => [
                    'class' => 'thematic'
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
            ->add('skills', CheckboxType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
                'multiple' => true,
                'label' => 'Compétences',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('keywords', TextType::class, [
                'label' => 'Mots clés',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté * :',
                'choices' => [
                    Constant::class,
                ],
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'difficulte',
                ],
                'required' => true,
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Durée (en heure):',
                'attr' => [
                    'class' => 'duree',
                ],
            ])
            ->add('origin_id', EntityType::class, [
                'class' => Origin::class,
                'choice_label' => 'id',
                'label' => 'Origine :',
                'class' => 'App\Entity\Origin',
                'attr' => [
                    'class' => 'origin',
                ],
                'required' => false,
            ])
            ->add('origin_name', EntityType::class, [
                'label' => 'Nom du livre/Lien du site :',
                'attr' => [
                    'class' => 'origin_name',
                ],
                'required' => false,
            ])
            ->add('origin_information', EntityType::class, [
                'label' => 'Informations complémentaires :',
                'attr' => [
                    'class' => 'origin_info',
                ],
                'required' => false,
            ])
            /*->add('created_by_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])*/
            ->add('proposed_by_type',EntityType::class, [
                'label' => 'ou proposé par un :',
            ])
            ->add('proposed_by_first_name',EntityType::class,[
                'label' => 'Nom :',
                'required' => false,
                'attr' => [
                    'class' => 'nom'
                ],
            ])
            ->add('proposed_by_last_name',EntityType::class,[
                'label' => 'Prénom :',
                'required' => false,
                'attr' => [
                    'class' => 'prenom'
                ],
            ])
            ->add('exercice_file_id', FileType::class, [
                'class' => File::class,
                'choice_label' => 'id',
                'label' => 'Fiche exercice (PDF,word)* :',
            ])
            ->add('correction_file_id', FileType::class, [
                'class' => File::class,
                'choice_label' => 'id',
                'label' => 'Fiche corrigé(PDF,word)* :',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
