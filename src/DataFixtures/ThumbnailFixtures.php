<?php

namespace App\DataFixtures;

use App\Entity\Thumbnail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThumbnailFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $thumbnail1 = new Thumbnail();
        $thumbnail1->setLink('img/ui-divya.jpg');
        $manager->persist($thumbnail1);
        $thumbnail2 = new Thumbnail();
        $thumbnail2->setLink('img/avatar.png');
        $manager->persist($thumbnail2);
        $thumbnail3 = new Thumbnail();
        $thumbnail3->setLink('img/ui-sam.jpg');
        $manager->persist($thumbnail3);
        $thumbnail4 = new Thumbnail();
        $thumbnail4->setLink('img/ui-danro.jpg');
        $manager->persist($thumbnail2);
        $manager->flush();
    }
}
