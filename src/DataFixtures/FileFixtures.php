<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $dataFile = [
            [
                'name' => 'ExerciceMaths_Arithmétique.pdf',
                'original_name' => '',
                'extension' => 'pdf',
                'size' => '',
            ],
            [
                'name' => 'ExerciceMaths_Multiplication.docx',
                'original_name' => '',
                'extension' => 'docx',
                'size' => '',
            ],
            [
                'name' => 'ExerciceMaths_Fonction_Dérivée.pdf',
                'original_name' => '',
                'extension' => 'pdf',
                'size' => '',
            ],
            [
                'name' => 'ExerciceMaths_Variable.pdf',
                'original_name' => '',
                'extension' => 'pdf',
                'size' => '',
            ],
        ];

        foreach($dataFile as $data)
        {
            $file = new File();
            $file->setName($data['name']);
            $file->setOriginalName($data['original_name']);
            $file->setExtension($data['extension']);
            $file->setSize($data['size']);

            $manager->persist($file);
        }

        $manager->flush();
    }
}
