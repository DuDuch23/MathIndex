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
            [
                'email' => 'john.d@gmail.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password1',
            ],
            [
                'email' => 'jane.s@example.com',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password2',
            ],
            [
                'email' => 'user3@example.com',
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password3',
            ],
            [
                'email' => 'user4@example.com',
                'first_name' => 'Bob',
                'last_name' => 'Brown',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password4',
            ],
            [
                'email' => 'user5@example.com',
                'first_name' => 'Emma',
                'last_name' => 'Davis',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password5',
            ],
            [
                'email' => 'user6@example.com',
                'first_name' => 'William',
                'last_name' => 'Wilson',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password6',
            ],
            [
                'email' => 'user7@example.com',
                'first_name' => 'Olivia',
                'last_name' => 'Martinez',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password7',
            ],
            [
                'email' => 'user8@example.com',
                'first_name' => 'Liam',
                'last_name' => 'Taylor',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password8',
            ],
            [
                'email' => 'user9@example.com',
                'first_name' => 'Sophia',
                'last_name' => 'Anderson',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password9',
            ],
            [
                'email' => 'user10@example.com',
                'first_name' => 'James',
                'last_name' => 'Thomas',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password10',
            ],
            [
                'email' => 'user11@example.com',
                'first_name' => 'Amelia',
                'last_name' => 'Hernandez',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password11',
            ],
            [
                'email' => 'user12@example.com',
                'first_name' => 'Benjamin',
                'last_name' => 'Moore',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password12',
            ],
            [
                'email' => 'user13@example.com',
                'first_name' => 'Emily',
                'last_name' => 'Garcia',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password13',
            ],
            [
                'email' => 'user14@example.com',
                'first_name' => 'Lucas',
                'last_name' => 'Lee',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password14',
            ],
            [
                'email' => 'user15@example.com',
                'first_name' => 'Mia',
                'last_name' => 'Lopez',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password15',
            ],
            [
                'email' => 'user16@example.com',
                'first_name' => 'Alexander',
                'last_name' => 'Clark',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password16',
            ],
            [
                'email' => 'user17@example.com',
                'first_name' => 'Charlotte',
                'last_name' => 'Rodriguez',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password17',
            ],
            [
                'email' => 'user18@example.com',
                'first_name' => 'Daniel',
                'last_name' => 'Lewis',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password18',
            ],
            [
                'email' => 'user19@example.com',
                'first_name' => 'Harper',
                'last_name' => 'Hall',
                'role' => ['ROLE_CONTRIBUTEUR'],
                'password' => 'password19',
            ],
            [
                'email' => 'user20@example.com',
                'first_name' => 'Michael',
                'last_name' => 'Young',
                'role' => ['ROLE_ADMIN'],
                'password' => 'password20',
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
