<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public const FILE = [
            [
                'name' => 'ExerciceMaths_Arithmétique.pdf',
                'original_name' => 'Exercice Arithmétique',
                'extension' => 'docx',
                'size' => 500,
            ],
            [
                'name' => 'ExerciceMaths_Multiplication.docx',
                'original_name' => 'Exercice Multiplication',
                'extension' => 'docx',
                'size' => 300,
            ],
            [
                'name' => 'ExerciceMaths_Fonction_Dérivée.pdf',
                'original_name' => 'Exercice fonction dérivée',
                'extension' => 'pdf',
                'size' => 800,
            ],
            [
                'name' => 'ExerciceMaths_Variable.pdf',
                'original_name' => 'Exercie variable',
                'extension' => 'pdf',
                'size' => 900,
            ],
            [
                'name' => 'ExerciceMaths_Algebre.pdf',
                'original_name' => 'Exercice Algèbre',
                'extension' => 'docx',
                'size' => 600,
            ],
            [
                'name' => 'ExerciceMaths_Geometrie.pdf',
                'original_name' => 'Exercice Géométrie',
                'extension' => 'pdf',
                'size' => 700,
            ],
            [
                'name' => 'ExerciceMaths_Probabilite.pdf',
                'original_name' => 'Exercice Probabilité',
                'extension' => 'pdf',
                'size' => 550,
            ],
            [
                'name' => 'ExerciceMaths_Calcul.pdf',
                'original_name' => 'Exercice Calcul',
                'extension' => 'pdf',
                'size' => 480,
            ],
            [
                'name' => 'ExerciceMaths_Algebre_Lineaire.docx',
                'original_name' => 'Exercice Algèbre Linéaire',
                'extension' => 'docx',
                'size' => 720,
            ],
            [
                'name' => 'ExerciceMaths_Integration.pdf',
                'original_name' => 'Exercice Intégration',
                'extension' => 'pdf',
                'size' => 620,
            ],
            [
                'name' => 'ExerciceMaths_Logarithme.docx',
                'original_name' => 'Exercice Logarithme',
                'extension' => 'docx',
                'size' => 430,
            ],
            [
                'name' => 'ExerciceMaths_Graphique.pdf',
                'original_name' => 'Exercice Graphique',
                'extension' => 'pdf',
                'size' => 550,
            ],
            [
                'name' => 'ExerciceMaths_Algebre_Modulaire.pdf',
                'original_name' => 'Exercice Algèbre Modulaire',
                'extension' => 'pdf',
                'size' => 480,
            ],
            [
                'name' => 'ExerciceMaths_Statistique.docx',
                'original_name' => 'Exercice Statistique',
                'extension' => 'docx',
                'size' => 700,
            ],
            [
                'name' => 'ExerciceMaths_Limite.pdf',
                'original_name' => 'Exercice Limite',
                'extension' => 'pdf',
                'size' => 620,
            ],
            [
                'name' => 'ExerciceMaths_Trigonometrie.docx',
                'original_name' => 'Exercice Trigonométrie',
                'extension' => 'docx',
                'size' => 540,
            ],
            [
                'name' => 'ExerciceMaths_Equation_Differentielle.pdf',
                'original_name' => 'Exercice Équation Différentielle',
                'extension' => 'pdf',
                'size' => 680,
            ],
            [
                'name' => 'ExerciceMaths_Fonction_Quadratique.docx',
                'original_name' => 'Exercice Fonction Quadratique',
                'extension' => 'docx',
                'size' => 450,
            ],
            [
                'name' => 'ExerciceMaths_Arithmetique_Correction.docx',
                'original_name' => 'Exercice Arithmétique',
                'extension' => 'docx',
                'size' => 500,
            ],
            [
                'name' => 'ExerciceMaths_Multiplication_Correction.docx',
                'original_name' => 'Exercice Multiplication',
                'extension' => 'docx',
                'size' => 300,
            ],
            [
                'name' => 'ExerciceMaths_Fonction_Derivee_Correction.pdf',
                'original_name' => 'Exercice fonction dérivée',
                'extension' => 'pdf',
                'size' => 800,
            ],
            [
                'name' => 'ExerciceMaths_Variable_Correction.pdf',
                'original_name' => 'Exercice variable',
                'extension' => 'pdf',
                'size' => 900,
            ],
            [
                'name' => 'ExerciceMaths_Algebre_Correction.docx',
                'original_name' => 'Exercice Algèbre',
                'extension' => 'docx',
                'size' => 600,
            ],
            [
                'name' => 'ExerciceMaths_Geometrie_Correction.pdf',
                'original_name' => 'Exercice Géométrie',
                'extension' => 'pdf',
                'size' => 700,
            ],
            [
                'name' => 'ExerciceMaths_Probabilite_Correction.pdf',
                'original_name' => 'Exercice Probabilité',
                'extension' => 'pdf',
                'size' => 550,
            ],
            [
                'name' => 'ExerciceMaths_Calcul_Correction.pdf',
                'original_name' => 'Exercice Calcul',
                'extension' => 'pdf',
                'size' => 480,
            ],
            [
                'name' => 'ExerciceMaths_Algebre_Lineaire_Correction.docx',
                'original_name' => 'Exercice Algèbre Linéaire',
                'extension' => 'docx',
                'size' => 720,
            ],
            [
                'name' => 'ExerciceMaths_Integration_Correction.pdf',
                'original_name' => 'Exercice Intégration',
                'extension' => 'pdf',
                'size' => 620,
            ],
            [
                'name' => 'ExerciceMaths_Logarithme_Correction.docx',
                'original_name' => 'Exercice Logarithme',
                'extension' => 'docx',
                'size' => 430,
            ],
            [
                'name' => 'ExerciceMaths_Graphique_Correction.pdf',
                'original_name' => 'Exercice Graphique',
                'extension' => 'pdf',
                'size' => 550,
            ],
            [
                'name' => 'ExerciceMaths_Algebre_Modulaire_Correction.pdf',
                'original_name' => 'Exercice Algèbre Modulaire',
                'extension' => 'pdf',
                'size' => 480,
            ],
            [
                'name' => 'ExerciceMaths_Statistique_Correction.docx',
                'original_name' => 'Exercice Statistique',
                'extension' => 'docx',
                'size' => 700,
            ],
            [
                'name' => 'ExerciceMaths_Limite_Correction.pdf',
                'original_name' => 'Exercice Limite',
                'extension' => 'pdf',
                'size' => 620,
            ],
            [
                'name' => 'ExerciceMaths_Trigonometrie_Correction.docx',
                'original_name' => 'Exercice Trigonométrie',
                'extension' => 'docx',
                'size' => 540,
            ],
            [
                'name' => 'ExerciceMaths_Equation_Differentielle_Correction.pdf',
                'original_name' => 'Exercice Équation Différentielle',
                'extension' => 'pdf',
                'size' => 680,
            ],
            [
                'name' => 'ExerciceMaths_Fonction_Quadratique_Correction.docx',
                'original_name' => 'Exercice Fonction Quadratique',
                'extension' => 'docx',
                'size' => 450,
            ]
        ];

    public function load(ObjectManager $manager)
    {
        foreach(self::FILE as $data => $attributes)
        {
            $file = new File();
            $file->setName($attributes['name']);
            $file->setOriginalName($attributes['original_name']);
            $file->setExtension($attributes['extension']);
            $file->setSize($attributes['size']);

            $manager->persist($file);

            $this->addReference($data, $file);
        }

        $manager->flush();
    }
}
