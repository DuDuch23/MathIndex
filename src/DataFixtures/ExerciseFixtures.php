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
                'name' => 'Exercice Maths Equation différentiel',
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
                'name' => 'Exercice Maths Equation différentiel',
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
                'name' => 'Exercice Maths Equation différentiel',
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
                'name' => 'Exercice Maths Equation différentiel',
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
                'name' => 'Exercice Maths Equation différentiel',
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
                'name' => 'Exercice Maths Statistiques',
                'chapter' => 'Chapitre 7',
                'keywords' => 'statistiques',
                'difficulty' => '10',
                'duration' => '2',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 50-52',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Trigonométrie',
                'chapter' => 'Chapitre 8',
                'keywords' => 'trigonométrie',
                'difficulty' => '8',
                'duration' => '1.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 100-102',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths Géométrie',
                'chapter' => 'Chapitre 6',
                'keywords' => 'géométrie',
                'difficulty' => '6',
                'duration' => '1.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 80-82',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ],
            // Ajoutez d'autres exercices selon vos besoins
            // Exemple :
            [
                'name' => 'Exercice Maths Probabilités',
                'chapter' => 'Chapitre 10',
                'keywords' => 'probabilités',
                'difficulty' => '12',
                'duration' => '2',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 120-122',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Oulekiari',
            ],
            [
                'name' => 'Exercice Maths Calcul intégral',
                'chapter' => 'Chapitre 11',
                'keywords' => 'calcul intégral',
                'difficulty' => '16',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 130-132',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths Suites numériques',
                'chapter' => 'Chapitre 12',
                'keywords' => 'suites numériques',
                'difficulty' => '18',
                'duration' => '3.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 140-142',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            // Ajoutez d'autres exercices selon vos besoins
            // Exemple :
            [
                'name' => 'Exercice Maths Logarithmes',
                'chapter' => 'Chapitre 13',
                'keywords' => 'logarithmes',
                'difficulty' => '14',
                'duration' => '2.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 150-152',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ],
            [
                'name' => 'Exercice Maths Fonctions trigonométriques',
                'chapter' => 'Chapitre 14',
                'keywords' => 'fonctions trigonométriques',
                'difficulty' => '9',
                'duration' => '1.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 160-162',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Oulekiari',
            ],
            [
                'name' => 'Exercice Maths Équations et inéquations',
                'chapter' => 'Chapitre 15',
                'keywords' => 'équations inéquations',
                'difficulty' => '11',
                'duration' => '2',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 170-172',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths Géométrie analytique',
                'chapter' => 'Chapitre 16',
                'keywords' => 'géométrie analytique',
                'difficulty' => '13',
                'duration' => '2.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 180-182',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Calcul matriciel',
                'chapter' => 'Chapitre 17',
                'keywords' => 'calcul matriciel',
                'difficulty' => '17',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 190-192',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ],
            [
                'name' => 'Exercice Maths Polynômes',
                'chapter' => 'Chapitre 18',
                'keywords' => 'polynômes',
                'difficulty' => '10',
                'duration' => '2',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 200-202',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Oulekiari',
            ],
            [
                'name' => 'Exercice Maths Combinatoire',
                'chapter' => 'Chapitre 19',
                'keywords' => 'combinatoire',
                'difficulty' => '14',
                'duration' => '2.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 210-212',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths Séries numériques',
                'chapter' => 'Chapitre 20',
                'keywords' => 'séries numériques',
                'difficulty' => '16',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 220-222',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Équations différentielles',
                'chapter' => 'Chapitre 21',
                'keywords' => 'équations différentielles',
                'difficulty' => '18',
                'duration' => '3.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 230-232',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ],
            [
                'name' => 'Exercice Maths Intégrales généralisées',
                'chapter' => 'Chapitre 22',
                'keywords' => 'intégrales généralisées',
                'difficulty' => '12',
                'duration' => '2',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 240-242',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Oulekiari',
            ],
            [
                'name' => 'Exercice Maths Équations diophantiennes',
                'chapter' => 'Chapitre 23',
                'keywords' => 'équations diophantiennes',
                'difficulty' => '14',
                'duration' => '2.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 250-252',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths Théorème des valeurs intermédiaires',
                'chapter' => 'Chapitre 24',
                'keywords' => 'théorème des valeurs intermédiaires',
                'difficulty' => '16',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 260-262',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Transformations géométriques',
                'chapter' => 'Chapitre 25',
                'keywords' => 'transformations géométriques',
                'difficulty' => '18',
                'duration' => '3.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 270-272',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ],
            [
                'name' => 'Exercice Maths Espaces vectoriels',
                'chapter' => 'Chapitre 26',
                'keywords' => 'espaces vectoriels',
                'difficulty' => '20',
                'duration' => '4',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 280-282',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Oulekiari',
            ],
            [
                'name' => 'Exercice Maths Algorithme de recherche de racine',
                'chapter' => 'Chapitre 27',
                'keywords' => 'algorithme recherche racine',
                'difficulty' => '15',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 290-292',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Romain',
                'proposed_by_last_name' => 'Fernandes',
            ],
            [
                'name' => 'Exercice Maths Théorème de Gauss-Bonnet',
                'chapter' => 'Chapitre 28',
                'keywords' => 'théorème de Gauss-Bonnet',
                'difficulty' => '19',
                'duration' => '3.5',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 300-302',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Alexandre',
                'proposed_by_last_name' => 'Duchemin',
            ],
            [
                'name' => 'Exercice Maths Produit scalaire',
                'chapter' => 'Chapitre 29',
                'keywords' => 'produit scalaire',
                'difficulty' => '17',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 310-312',
                'proposed_by_type' => 'Enseignant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ],
            [
                'name' => 'Exercice Maths Calcul des limites',
                'chapter' => 'Chapitre 30',
                'keywords' => 'calcul des limites',
                'difficulty' => '16',
                'duration' => '3',
                'origin_name' => 'Manuel Maths',
                'origin_information' => 'Page 320-322',
                'proposed_by_type' => 'Etudiant',
                'proposed_by_first_name' => 'Kilian',
                'proposed_by_last_name' => 'Delatraz',
            ]
        ];

        $userData = UserFixtures::USER;
        $i=0;
        foreach($dataExercise as $data)
        {
            $exercise = new Exercise();
            $i++;
            $courseReference = array_rand(CourseFixtures::COURSE);
            $classroomReference = array_rand(ClassroomFixtures::CLASSROOM);
            $thematicReference = array_rand(ThematicFixtures::THEMATIC);
            $originReference = array_rand(OriginFixtures::ORIGIN);
            $enonce = $i;
            $i++;
            $correction = $i;

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
            $exercise->setExerciseFileId($this->getReference($enonce));
            $exercise->setCorrectionFileId($this->getReference($correction));
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