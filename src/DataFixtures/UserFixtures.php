<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFname('John');
        $user->setLname('Doe');
        $user->setPicture('avatar.png');
        $user->setEmail('john.doe@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user, 'usertest');
        $user->setPassword($password);


        $manager->persist($user);
    
        $manager->flush();
    }
}
