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
                'email' => 'student@gmail.com',
                'last_name' => 'student',
                'first_name' => 'student',
                'role' => ["ROLE_STUDENT"],
                'password' => 'compteStudent',
            ],
            [
                'email' => 'teacherM@gmail.com',
                'last_name' => 'teacher',
                'first_name' => 'maths',
                'role' => ["ROLE_TEACHER"],
                'password' => 'compteTeacherM',
            ],
            [
                'email' => 'teacherFR@gmail.com',
                'last_name' => 'teacher',
                'first_name' => 'français',
                'role' => ["ROLE_TEACHER"],
                'password' => 'compteTeacherFR',
            ],
            [
                'email' => 'admin@gmail.com',
                'last_name' => 'adminLastName',
                'first_name' => 'adminFirstName',
                'role' => ["ROLE_ADMIN"],
                'password' => 'AdminPassword',
            ],
            [
                'email' => 'john.d@gmail.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'role' => ['ROLE_STUDENT'],
                'password' => 'password1',
            ],
            [
                'email' => 'user3@example.com',
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'role' => ['ROLE_STUDENT'],
                'password' => 'password3',
            ],
            [
                'email' => 'user5@example.com',
                'first_name' => 'Emma',
                'last_name' => 'Davis',
                'role' => ['ROLE_TEACHER'],
                'password' => 'password5',
            ],
            [
                'email' => 'user7@example.com',
                'first_name' => 'Olivia',
                'last_name' => 'Martinez',
                'role' => ['ROLE_TEACHER'],
                'password' => 'password7',
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
