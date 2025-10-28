<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
