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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class)
        ->add('courseId', EntityType::class, [
            'class' => Course::class,
            'choice_label' => 'name',
        ])
        ->add('difficulty', ChoiceType::class, [
            'choices' => array_combine(range(1, 20), range(1, 20)), // Crée un tableau de 1 à 20
            'label' => 'Difficulté',
        ])
        ->add('thematicId', EntityType::class, [
            'class' => Thematic::class,
            'choice_label' => 'name',
        ])
        ->add('exercice_file_id', VichFileType::class, [
            'required' => false,
            'label' => 'Fichier d\'exercice',
            'allow_delete' => true,
            'download_uri' => true,
            'mapped' => false,
            'attr' => ['class' => 'form-control']
        ])
        ->add('correction_file_id', VichFileType::class, [
            'required' => false,
            'label' => 'Fichier de correction',
            'allow_delete' => true,
            'download_uri' => true,
            'mapped' => false,
            'attr' => ['class' => 'form-control']
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => [
            'class' => 'btn',
            ],
            'row_attr' => [
                'class' => 'flex justify-center',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
