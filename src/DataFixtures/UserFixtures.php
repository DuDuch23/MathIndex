<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $dataUser = [
            [
                'email' => 'ExerciceMaths_Arithmétique.pdf',
                'last_name' => '',
                'first_name' => 'pdf',
                'role' => '',
                'password' => '',
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

        foreach($dataUser as $data)
        {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setLastName($data['last_name']);
            $user->setFirstName($data['first_name']);
            $user->setRole($data['role']);
            $user->setRole($data['password']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
