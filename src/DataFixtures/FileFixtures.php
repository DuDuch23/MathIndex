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
                'original_name' => '',
                'extension' => 'pdf',
                'size' => '500',
            ],
            [
                'name' => 'ExerciceMaths_Multiplication.docx',
                'original_name' => '',
                'extension' => 'docx',
                'size' => '2',
            ],
            [
                'name' => 'ExerciceMaths_Fonction_Dérivée.pdf',
                'original_name' => '',
                'extension' => 'pdf',
                'size' => '800',
            ],
            [
                'name' => 'ExerciceMaths_Variable.pdf',
                'original_name' => '',
                'extension' => 'pdf',
                'size' => '900',
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
