<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture
{
    public const MATHEMATIQUE = 'COURSE_MATHEMATIQUE';
    public const FRANCAIS = 'COURSE_FRANCAIS';
    public const PHYSIQUE = 'COURSE_PHYSIQUE';

    public const COURSE = [
        self::MATHEMATIQUE => [
            'name' => 'Mathématique',
        ],
        self::FRANCAIS => [
            'name' => 'Français',
        ],
        self::PHYSIQUE => [
            'name' => 'Phisique',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach($this::COURSE as $code => $attributes)
        {
            $course = new Course();
            $course->setName($attributes['name']);

            $manager->persist($course);

            $this->addReference($code, $course);
        }

        $manager->flush();
    }
}
