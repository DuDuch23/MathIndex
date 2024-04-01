<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const USER = [
            [
                'email' => 'romain@gmail.com',
                'last_name' => 'Fernandes',
                'first_name' => 'Romain',
                'role' => ["ROLE_CONTRIBUTEUR"],
                'password' => 'motDePasse',
            ],
            [
                'email' => 'kilian.O@gmail.com',
                'last_name' => 'Oulekhiari',
                'first_name' => 'Kilian',
                'role' => ["ROLE_CONTRIBUTEUR"],
                'password' => 'password',
            ],
            [
                'email' => 'killian.D@gmail.com',
                'last_name' => 'Deletraz',
                'first_name' => 'Killian',
                'role' => ["ROLE_CONTRIBUTEUR"],
                'password' => '1234',
            ],
            [
                'email' => 'alexduduch77@gmail.com',
                'last_name' => 'Duchemin',
                'first_name' => 'Alexandre',
                'role' => ["ROLE_ADMIN"],
                'password' => '1234',
            ],
            [
                'email' => 'admin.@gmail@gmail.com',
                'last_name' => 'Admin_last_name',
                'first_name' => 'Admin_first_name',
                'role' => ["ROLE_ADMIN"],
                'password' => 'admin5678',
            ],
        ];
    
    public function load(ObjectManager $manager)
    {
        foreach(self::USER as $attributes)
        {
            $user = new User();
            $user->setEmail($attributes['email']);
            $user->setLastName($attributes['last_name']);
            $user->setFirstName($attributes['first_name']);
            $user->setRoles($attributes['role']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $attributes['password']));

            $manager->persist($user);

            $this->addReference($attributes['last_name'] . '-' . $attributes['first_name'], $user);
        }

        $manager->flush();
    }
}
