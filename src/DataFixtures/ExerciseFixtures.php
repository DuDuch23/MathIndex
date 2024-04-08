<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExerciseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dataExercise = [
            [
                'name' => 'Exercice Maths Algèbre',
                'chapter' => 'Chapitre 5',
                'keywords' => 'algèbre',
                'difficulty' => '5',
                'duration' => '1',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 12, 2ème paragraphe',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Equation différentiel',
                'chapter' => 'Chapitre 9',
                'keywords' => 'equation',
                'difficulty' => '15',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 1-19',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Multiplications',
                'chapter' => 'Chapitre 3',
                'keywords' => 'multiplication',
                'difficulty' => '3',
                'duration' => '1',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 1, 2ème paragraphe',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Deletraz',
            ],
            [
                'name' => 'Exercice Maths Fonction dérivé',
                'chapter' => 'Chapitre 5',
                'keywords' => 'fonction dérivé',
                'difficulty' => '13',
                'duration' => '2.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 4, 1er paragraphe',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths integration',
                'chapter' => 'Chapitre 9',
                'keywords' => 'equation',
                'difficulty' => '15',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 1-19',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths algèbre linéaire ',
                'chapter' => 'Chapitre 9',
                'keywords' => 'equation',
                'difficulty' => '15',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 1-19',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
        ];

        $userData = UserFixtures::USER;

        foreach($dataExercise as $data)
        {
            $exercise = new Exercise();

            $courseReference = array_rand(CourseFixtures::COURSE);
            $classroomReference = array_rand(ClassroomFixtures::CLASSROOM);
            $thematicReference = array_rand(ThematicFixtures::THEMATIC);
            $originReference = array_rand(OriginFixtures::ORIGIN);
            $fileReferenceExercice = array_rand(FileFixtures::FILE);
            $fileReferenceCorrection = array_rand(FileFixtures::FILE);
            $randomUser = $userData[array_rand($userData)];
            $userReference = $randomUser['last_name'] . '-' . $randomUser['first_name'];

            $exercise->setName($data['name']);
            $exercise->setCourseId($this->getReference($courseReference));
            $exercise->setClassroomId($this->getReference($classroomReference));
            $exercise->setThematicId($this->getReference($thematicReference));
            $exercise->setChapter($data['chapter']);
            $exercise->setKeywords($data['keywords']);
            $exercise->setDifficulty($data['difficulty']);
            $exercise->setDuration($data['duration']);
            $exercise->setOriginId($this->getReference($originReference));
            $exercise->setOriginName($data['origin_name']);
            $exercise->setOriginInformation($data['origin_information']);
            $exercise->setProposedByType($data['proposed_by_type']);
            $exercise->setProposedByFirstName($data['proposed_by_first_name']);
            $exercise->setProposedByLastName($data['proposed_by_last_name']);
            $exercise->setExerciseFileId($this->getReference($fileReferenceExercice));
            $exercise->setCorrectionFileId($this->getReference($fileReferenceCorrection));
            $exercise->setCreatedById($this->getReference($userReference));

            $manager->persist($exercise);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            CourseFixtures::class,
            ClassroomFixtures::class,
            ThematicFixtures::class,
            OriginFixtures::class,
            FileFixtures::class,
            UserFixtures::class,
        ];
    }
}