<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassroomFixtures extends Fixture
{
    public const SECONDE = 'CLASSROOM_SECONDE';
    public const PREMIERE = 'CLASSROOM_PREMIERE';
    public const TERMINALE = 'CLASSROOM_TERMINALE';

    public const CLASSROOM = [
        self::SECONDE => [
            'name' => 'Seconde',
        ],
        self::PREMIERE => [
            'name' => 'Première',
        ],
        self::TERMINALE => [
            'name' => 'Terminale',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach($this::CLASSROOM as $code => $attributes)
        {
            $classroom = new Classroom();
            $classroom->setName($attributes['name']);

            $manager->persist($classroom);

            $this->addReference($code, $classroom);
        }

        $manager->flush();
    }
}