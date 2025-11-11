<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
        {
        
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = New User();
        $user1->setEmail('test@test.com');
        $user1->setPassword($this->userPasswordHasher->hashPassword(
            $user1,
            '12345678'
        ));
        $manager->persist($user1);
        
        $user2 = New User();
        $user2->setEmail('test2@test.com');
        $user2->setPassword($this->userPasswordHasher->hashPassword(
            $user2,
            '12345678'
        ));
        $manager->persist($user2);
        // $product = new Product();
        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to Poland');
        $microPost1->setText('Welcome here to Poland');
        $microPost1->setCreated(new DateTime());
        // $manager->persist($product);
        $manager->persist($microPost1); // saved in memory

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to US');
        $microPost2->setText('Welcome here to US');
        $microPost2->setCreated(new DateTime());
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Welcome to Germany');
        $microPost3->setText('Welcome here to Germany');
        $microPost3->setCreated(new DateTime());
        $manager->persist($microPost3);

        $manager->flush(); // executed to write in DBB
    }
}
