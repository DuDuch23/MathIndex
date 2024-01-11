<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER = [
            [
                'email' => 'romain@gmail.com',
                'last_name' => 'Fernandes',
                'first_name' => 'Romain',
                'role' => 'Contributeur',
                'password' => 'motDePasse',
            ],
            [
                'email' => 'kilian.O@gmail.com',
                'last_name' => 'Oulekhiari',
                'first_name' => 'Kilian',
                'role' => 'Visiteur',
                'password' => 'password',
            ],
            [
                'email' => 'kilian.D@gmail.com',
                'last_name' => 'Deletraz',
                'first_name' => 'Kilian',
                'role' => 'Visiteur',
                'password' => '1234',
            ],
            [
                'email' => 'alexandre@gmail.com',
                'last_name' => 'Duchemin',
                'first_name' => 'Alexandre',
                'role' => 'Contributeur',
                'password' => 'azerty',
            ],
            [
                'email' => 'alexduduch77@gmail.com',
                'last_name' => 'Duchemin',
                'first_name' => 'Alexandre',
                'role' => 'Administrateur',
                'password' => 'admin1234',
            ],
            [
                'email' => 'kilian.Oulekhiari@gmail.com',
                'last_name' => 'Oulekhiari',
                'first_name' => 'Kilian',
                'role' => 'Administrateur',
                'password' => 'admin1234',
            ],
            [
                'email' => 'kilian.Deletraz@gmail.com',
                'last_name' => 'Deletraz',
                'first_name' => 'Kilian',
                'role' => 'Administrateur',
                'password' => 'admin5678',
            ],
            [
                'email' => 'romain.Fernandes@gmail.com',
                'last_name' => 'Fernandes',
                'first_name' => 'Romain',
                'role' => 'Administrateur',
                'password' => 'admin5678',
            ],
        ];
    
    public function load(ObjectManager $manager)
    {
        foreach(self::USER as $data => $attributes)
        {
            $user = new User();
            $user->setEmail($attributes['email']);
            $user->setLastName($attributes['last_name']);
            $user->setFirstName($attributes['first_name']);
            $user->setRole($attributes['role']);
            $user->setPassword($attributes['password']);

            $manager->persist($user);

            $this->addReference('user_' . $data, $user);
        }

        $manager->flush();
    }
}
