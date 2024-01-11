<?php

namespace App\DataFixtures;

use App\Entity\Thematic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ThematicFixtures extends Fixture implements DependentFixtureInterface
{
    public const ARITHMETIQUE = 'THEMATIC_ARITHMETIQUE';
    public const GEOMETRIE = 'THEMATIC_GEOMETRIE';
    public const ALGEBRE = 'THEMATIC_ALGEBRE';
    public const PROBABILITESTATISTIQUE = 'THEMATIC_PROBABILITESTATISTIQUE';
    public const FRACTION = 'THEMATIC_FRACTION';
    public const TRIGONOMETRIE = 'THEMATIC_TRIGONOMETRIE';
    public const EQUATIONDIFFERENTIELLE = 'THEMATIC_EQUATIONDIFFERENTIELLE';
    public const CALCULVECTORIEL = 'THEMATIC_CALCULVECTORIEL';

    public const THEMATIC = [
        self::ARITHMETIQUE => [
            'name' => 'Arithmétique',
        ],
        self::GEOMETRIE => [
            'name' => 'Géométrie',
        ],
        self::ALGEBRE => [
            'name' => 'Algèbre',
        ],
        self::PROBABILITESTATISTIQUE => [
            'name' => 'Probabilités et statistiques',
        ],
        self::FRACTION => [
            'name' => 'Fraction',
        ],
        self::TRIGONOMETRIE => [
            'name' => 'Trigonométrie',
        ],
        self::EQUATIONDIFFERENTIELLE => [
            'name' => 'Equation différentielle',
        ],
        self::CALCULVECTORIEL => [
            'name' => 'Calcul vectoriel',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach($this::THEMATIC as $code => $attributes)
        {
            $thematic = new Thematic();
            $thematic->setName($attributes['name']);

            $courseReference = array_rand(CourseFixtures::COURSE);
            $thematic->setCourseId($this->getReference($courseReference));

            $manager->persist($thematic);

            $this->addReference($code, $thematic);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            CourseFixtures::class,
        ];
    }
}