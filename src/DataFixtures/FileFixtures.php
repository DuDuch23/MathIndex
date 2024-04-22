<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public const FILE = [
        0 => [
            'name' => 'ExerciceMaths_Arithmetique.pdf',
            'original_name' => 'Exercice Arithmétique',
            'extension' => 'docx',
            'size' => 500,
        ],
        1 => [
            'name' => 'ExerciceMaths_Multiplication.docx',
            'original_name' => 'Exercice Multiplication',
            'extension' => 'docx',
            'size' => 300,
        ],
        2 => [
            'name' => 'ExerciceMaths_Fonction_Derivee.pdf',
            'original_name' => 'Exercice fonction dérivée',
            'extension' => 'pdf',
            'size' => 800,
        ],
        3 => [
            'name' => 'ExerciceMaths_Variable.pdf',
            'original_name' => 'Exercie variable',
            'extension' => 'pdf',
            'size' => 900,
        ],
        4 => [
            'name' => 'ExerciceMaths_Algebre.pdf',
            'original_name' => 'Exercice Algèbre',
            'extension' => 'docx',
            'size' => 600,
        ],
        5 => [
            'name' => 'ExerciceMaths_Geometrie.pdf',
            'original_name' => 'Exercice Géométrie',
            'extension' => 'pdf',
            'size' => 700,
        ],
        6 => [
            'name' => 'ExerciceMaths_Probabilite.pdf',
            'original_name' => 'Exercice Probabilité',
            'extension' => 'pdf',
            'size' => 550,
        ],
        7 => [
            'name' => 'ExerciceMaths_Calcul.pdf',
            'original_name' => 'Exercice Calcul',
            'extension' => 'pdf',
            'size' => 480,
        ],
        8 => [
            'name' => 'ExerciceMaths_Algebre_Lineaire.docx',
            'original_name' => 'Exercice Algèbre Linéaire',
            'extension' => 'docx',
            'size' => 720,
        ],
        9 => [
            'name' => 'ExerciceMaths_Integration.pdf',
            'original_name' => 'Exercice Intégration',
            'extension' => 'pdf',
            'size' => 620,
        ],
        10 => [
            'name' => 'ExerciceMaths_Logarithme.docx',
            'original_name' => 'Exercice Logarithme',
            'extension' => 'docx',
            'size' => 430,
        ],
        11 => [
            'name' => 'ExerciceMaths_Graphique.pdf',
            'original_name' => 'Exercice Graphique',
            'extension' => 'pdf',
            'size' => 550,
        ],
        12 => [
            'name' => 'ExerciceMaths_Algebre_Modulaire.pdf',
            'original_name' => 'Exercice Algèbre Modulaire',
            'extension' => 'pdf',
            'size' => 480,
        ],
        13 => [
            'name' => 'ExerciceMaths_Statistique.docx',
            'original_name' => 'Exercice Statistique',
            'extension' => 'docx',
            'size' => 700,
        ],
        14 => [
            'name' => 'ExerciceMaths_Limite.pdf',
            'original_name' => 'Exercice Limite',
            'extension' => 'pdf',
            'size' => 620,
        ],
        15 => [
            'name' => 'ExerciceMaths_Trigonometrie.docx',
            'original_name' => 'Exercice Trigonométrie',
            'extension' => 'docx',
            'size' => 540,
        ],
        16 => [
            'name' => 'ExerciceMaths_Equation_Differentielle.pdf',
            'original_name' => 'Exercice Équation Différentielle',
            'extension' => 'pdf',
            'size' => 680,
        ],
        17 => [
            'name' => 'ExerciceMaths_Fonction_Quadratique.docx',
            'original_name' => 'Exercice Fonction Quadratique',
            'extension' => 'docx',
            'size' => 450,
        ],
        18 => [
            'name' => 'ExerciceMaths_Arithmetique_Correction.docx',
            'original_name' => 'Exercice Arithmétique',
            'extension' => 'docx',
            'size' => 500,
        ],
        19 => [
            'name' => 'ExerciceMaths_Multiplication_Correction.docx',
            'original_name' => 'Exercice Multiplication',
            'extension' => 'docx',
            'size' => 300,
        ],
        20 => [
            'name' => 'ExerciceMaths_Fonction_Derivee_Correction.pdf',
            'original_name' => 'Exercice fonction dérivée',
            'extension' => 'pdf',
            'size' => 800,
        ],
        21 => [
            'name' => 'ExerciceMaths_Variable_Correction.pdf',
            'original_name' => 'Exercice variable',
            'extension' => 'pdf',
            'size' => 900,
        ],
        22 => [
            'name' => 'ExerciceMaths_Algebre_Correction.docx',
            'original_name' => 'Exercice Algèbre',
            'extension' => 'docx',
            'size' => 600,
        ],
        23 => [
            'name' => 'ExerciceMaths_Geometrie_Correction.pdf',
            'original_name' => 'Exercice Géométrie',
            'extension' => 'pdf',
            'size' => 700,
        ],
        24 => [
            'name' => 'ExerciceMaths_Probabilite_Correction.pdf',
            'original_name' => 'Exercice Probabilité',
            'extension' => 'pdf',
            'size' => 550,
        ],
        25 => [
            'name' => 'ExerciceMaths_Calcul_Correction.pdf',
            'original_name' => 'Exercice Calcul',
            'extension' => 'pdf',
            'size' => 480,
        ],
        26 => [
            'name' => 'ExerciceMaths_Algebre_Lineaire_Correction.docx',
            'original_name' => 'Exercice Algèbre Linéaire',
            'extension' => 'docx',
            'size' => 720,
        ],
        27 => [
            'name' => 'ExerciceMaths_Integration_Correction.pdf',
            'original_name' => 'Exercice Intégration',
            'extension' => 'pdf',
            'size' => 620,
        ],
        28 => [
            'name' => 'ExerciceMaths_Logarithme_Correction.docx',
            'original_name' => 'Exercice Logarithme',
            'extension' => 'docx',
            'size' => 430,
        ],
        29 => [
            'name' => 'ExerciceMaths_Graphique_Correction.pdf',
            'original_name' => 'Exercice Graphique',
            'extension' => 'pdf',
            'size' => 550,
        ],
        30 => [
            'name' => 'ExerciceMaths_Algebre_Modulaire_Correction.pdf',
            'original_name' => 'Exercice Algèbre Modulaire',
            'extension' => 'pdf',
            'size' => 480,
        ],
        31 => [
            'name' => 'ExerciceMaths_Statistique_Correction.docx',
            'original_name' => 'Exercice Statistique',
            'extension' => 'docx',
            'size' => 700,
        ],
        32 => [
            'name' => 'ExerciceMaths_Limite_Correction.pdf',
            'original_name' => 'Exercice Limite',
            'extension' => 'pdf',
            'size' => 620,
        ],
        33 => [
            'name' => 'ExerciceMaths_Trigonometrie_Correction.docx',
            'original_name' => 'Exercice Trigonométrie',
            'extension' => 'docx',
            'size' => 540,
        ],
        34 => [
            'name' => 'ExerciceMaths_Equation_Differentielle_Correction.pdf',
            'original_name' => 'Exercice Équation Différentielle',
            'extension' => 'pdf',
            'size' => 680,
        ],
        35 => [
            'name' => 'ExerciceMaths_Fonction_Quadratique_Correction.docx',
            'original_name' => 'Exercice Fonction Quadratique',
            'extension' => 'docx',
            'size' => 450,
        ],
        36 => [
            'name' => 'ExerciceMaths_Arithmetique_Correction.docx',
            'original_name' => 'Exercice Arithmétique',
            'extension' => 'docx',
            'size' => 500,
        ],
        37 => [
            'name' => 'ExerciceMaths_Arithmetique.pdf',
            'original_name' => 'Exercice Arithmétique',
            'extension' => 'docx',
            'size' => 500,
        ],
        38 => [
            'name' => 'ExerciceMaths_Multiplication.docx',
            'original_name' => 'Exercice Multiplication',
            'extension' => 'docx',
            'size' => 300,
        ],
        39 => [
            'name' => 'ExerciceMaths_Fonction_Derivee.pdf',
            'original_name' => 'Exercice fonction dérivée',
            'extension' => 'pdf',
            'size' => 800,
        ],
        40 => [
            'name' => 'ExerciceMaths_Variable.pdf',
            'original_name' => 'Exercie variable',
            'extension' => 'pdf',
            'size' => 900,
        ],
        41 => [
            'name' => 'ExerciceMaths_Algebre.pdf',
            'original_name' => 'Exercice Algèbre',
            'extension' => 'docx',
            'size' => 600,
        ],
        42 => [
            'name' => 'ExerciceMaths_Geometrie.pdf',
            'original_name' => 'Exercice Géométrie',
            'extension' => 'pdf',
            'size' => 700,
        ],
        43 => [
            'name' => 'ExerciceMaths_Probabilite.pdf',
            'original_name' => 'Exercice Probabilité',
            'extension' => 'pdf',
            'size' => 550,
        ],
        44 => [
            'name' => 'ExerciceMaths_Calcul.pdf',
            'original_name' => 'Exercice Calcul',
            'extension' => 'pdf',
            'size' => 480,
        ],
        45 => [
            'name' => 'ExerciceMaths_Algebre_Lineaire.docx',
            'original_name' => 'Exercice Algèbre Linéaire',
            'extension' => 'docx',
            'size' => 720,
        ],
        46 => [
            'name' => 'ExerciceMaths_Integration.pdf',
            'original_name' => 'Exercice Intégration',
            'extension' => 'pdf',
            'size' => 620,
        ],
        47 => [
            'name' => 'ExerciceMaths_Logarithme.docx',
            'original_name' => 'Exercice Logarithme',
            'extension' => 'docx',
            'size' => 430,
        ],
        48 => [
            'name' => 'ExerciceMaths_Graphique.pdf',
            'original_name' => 'Exercice Graphique',
            'extension' => 'pdf',
            'size' => 550,
        ],
        49 => [
            'name' => 'ExerciceMaths_Algebre_Modulaire.pdf',
            'original_name' => 'Exercice Algèbre Modulaire',
            'extension' => 'pdf',
            'size' => 480,
        ],
        50 => [
            'name' => 'ExerciceMaths_Statistique.docx',
            'original_name' => 'Exercice Statistique',
            'extension' => 'docx',
            'size' => 700,
        ],
        51 => [
            'name' => 'ExerciceMaths_Limite.pdf',
            'original_name' => 'Exercice Limite',
            'extension' => 'pdf',
            'size' => 620,
        ],
        52 => [
            'name' => 'ExerciceMaths_Trigonometrie.docx',
            'original_name' => 'Exercice Trigonométrie',
            'extension' => 'docx',
            'size' => 540,
        ],
        53 => [
            'name' => 'ExerciceMaths_Equation_Differentielle.pdf',
            'original_name' => 'Exercice Équation Différentielle',
            'extension' => 'pdf',
            'size' => 680,
        ],
        54 => [
            'name' => 'ExerciceMaths_Fonction_Quadratique.docx',
            'original_name' => 'Exercice Fonction Quadratique',
            'extension' => 'docx',
            'size' => 450,
        ],
        55 => [
            'name' => 'ExerciceMaths_Arithmetique_Correction.docx',
            'original_name' => 'Exercice Arithmétique',
            'extension' => 'docx',
            'size' => 500,
        ],
        56 => [
            'name' => 'ExerciceMaths_Multiplication_Correction.docx',
            'original_name' => 'Exercice Multiplication',
            'extension' => 'docx',
            'size' => 300,
        ],
        57 => [
            'name' => 'ExerciceMaths_Fonction_Derivee_Correction.pdf',
            'original_name' => 'Exercice fonction dérivée',
            'extension' => 'pdf',
            'size' => 800,
        ],
        58 => [
            'name' => 'ExerciceMaths_Variable_Correction.pdf',
            'original_name' => 'Exercice variable',
            'extension' => 'pdf',
            'size' => 900,
        ],
        59 => [
            'name' => 'ExerciceMaths_Algebre_Correction.docx',
            'original_name' => 'Exercice Algèbre',
            'extension' => 'docx',
            'size' => 600,
        ],
        60 => [
            'name' => 'ExerciceMaths_Geometrie_Correction.pdf',
            'original_name' => 'Exercice Géométrie',
            'extension' => 'pdf',
            'size' => 700,
        ],
        61 => [
            'name' => 'ExerciceMaths_Probabilite_Correction.pdf',
            'original_name' => 'Exercice Probabilité',
            'extension' => 'pdf',
            'size' => 550,
        ],
        62 => [
            'name' => 'ExerciceMaths_Calcul_Correction.pdf',
            'original_name' => 'Exercice Calcul',
            'extension' => 'pdf',
            'size' => 480,
        ],
        63 => [
            'name' => 'ExerciceMaths_Algebre_Lineaire_Correction.docx',
            'original_name' => 'Exercice Algèbre Linéaire',
            'extension' => 'docx',
            'size' => 720,
        ],
        64 => [
            'name' => 'ExerciceMaths_Integration_Correction.pdf',
            'original_name' => 'Exercice Intégration',
            'extension' => 'pdf',
            'size' => 620,
        ],
        65 => [
            'name' => 'ExerciceMaths_Logarithme_Correction.docx',
            'original_name' => 'Exercice Logarithme',
            'extension' => 'docx',
            'size' => 430,
        ],
        66 => [
            'name' => 'ExerciceMaths_Graphique_Correction.pdf',
            'original_name' => 'Exercice Graphique',
            'extension' => 'pdf',
            'size' => 550,
        ],
        67 => [
            'name' => 'ExerciceMaths_Algebre_Modulaire_Correction.pdf',
            'original_name' => 'Exercice Algèbre Modulaire',
            'extension' => 'pdf',
            'size' => 480,
        ],
        68 => [
            'name' => 'ExerciceMaths_Statistique_Correction.docx',
            'original_name' => 'Exercice Statistique',
            'extension' => 'docx',
            'size' => 700,
        ],
        69 => [
            'name' => 'ExerciceMaths_Limite_Correction.pdf',
            'original_name' => 'Exercice Limite',
            'extension' => 'pdf',
            'size' => 620,
        ],
        70 => [
            'name' => 'ExerciceMaths_Trigonometrie_Correction.docx',
            'original_name' => 'Exercice Trigonométrie',
            'extension' => 'docx',
            'size' => 540,
        ],
        71 => [
            'name' => 'ExerciceMaths_Equation_Differentielle_Correction.pdf',
            'original_name' => 'Exercice Équation Différentielle',
            'extension' => 'pdf',
            'size' => 680,
        ],
        72 => [
            'name' => 'ExerciceMaths_Fonction_Quadratique_Correction.docx',
            'original_name' => 'Exercice Fonction Quadratique',
            'extension' => 'docx',
            'size' => 450,
        ],
        73 => [
            'name' => 'ExerciceMaths_Arithmetique_Correction.docx',
            'original_name' => 'Exercice Arithmétique',
            'extension' => 'docx',
            'size' => 500,
        ],
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
