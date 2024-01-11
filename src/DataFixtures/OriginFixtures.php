<?php

namespace App\DataFixtures;

use App\Entity\Origin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OriginFixtures extends Fixture
{
    public const LIVRE = 'ORIGIN_LIVRE';
    public const MANUEL = 'ORIGIN_MANUEL';

    public const ORIGIN = [
        self::LIVRE => [
            'name' => 'Livre',
        ],
        self::MANUEL => [
            'name' => 'Manuel',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach($this::ORIGIN as $code => $attributes)
        {
            $origin = new Origin();
            $origin->setName($attributes['name']);

            $manager->persist($origin);

            $this->addReference($code, $origin);
        }

        $manager->flush();
    }
}
