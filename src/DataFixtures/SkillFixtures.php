<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHERCHER = 'SKILL_CHERCHER';
    public const MODELISER = 'SKILL_MODELISER';
    public const REPRESENTER = 'SKILL_REPRESENTER';
    public const RAISONNER = 'SKILL_RAISONNER';
    public const CALCULER = 'SKILL_CALCULER';
    public const COMMUNIQUER = 'SKILL_COMMUNIQUER';

    public const SKILL = [
        self::CHERCHER => [
            'name' => 'Chercher',
        ],
        self::MODELISER => [
            'name' => 'Modéliser',
        ],
        self::REPRESENTER => [
            'name' => 'Représenter',
        ],
        self::RAISONNER => [
            'name' => 'Raisonner',
        ],
        self::CALCULER => [
            'name' => 'Calculer',
        ],
        self::COMMUNIQUER => [
            'name' => 'Communiquer',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach($this::SKILL as $code => $attributes)
        {
            $skill = new Skill();
            $skill->setName($attributes['name']);

            $courseReference = array_rand(CourseFixtures::COURSE);
            $skill->setCourseId($this->getReference($courseReference));

            $manager->persist($skill);
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