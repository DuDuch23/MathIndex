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
                'chapter' => 'Chapitre 1',
                'keywords' => 'algèbre',
                'difficulty' => '5',
                'duration' => '1',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 12, 2ème paragraphe',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
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
            $userReference = $randomUser['last_name'] . '_' . $randomUser['first_name'];

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
            $exercise->setExerciceFileId($this->getReference($fileReferenceExercice));
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