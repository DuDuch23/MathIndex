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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('chapter')
            ->add('keywords')
            ->add('difficulty')
            ->add('duration')
            ->add('origin_name')
            ->add('origin_information')
            ->add('proposed_by_type')
            ->add('proposed_by_first_name')
            ->add('proposed_by_last_name')
            ->add('course_id', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'id',
            ])
            ->add('classroom_id', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'id',
            ])
            ->add('thematic_id', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'id',
            ])
            ->add('origin_id', EntityType::class, [
                'class' => Origin::class,
                'choice_label' => 'id',
            ])
            ->add('exercice_file_id', EntityType::class, [
                'class' => File::class,
                'choice_label' => 'id',
            ])
            ->add('correction_file_id', EntityType::class, [
                'class' => File::class,
                'choice_label' => 'id',
            ])
            ->add('created_by_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
                'multiple' => true,
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
