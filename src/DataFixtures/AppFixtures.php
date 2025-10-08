<?php

namespace App\DataFixtures;

use App\Entity\CloudBox;
use App\Entity\CloudPhoto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $boxA = (new CloudBox())->setDescription('Boîte A - Nuages stratifiés');
        $boxB = (new CloudBox())->setDescription('Boîte B - Cumulus');
        $manager->persist($boxA);
        $manager->persist($boxB);
        
        $p1 = (new CloudPhoto())->setDescription('Cumulus au coucher du soleil')->setBox($boxB);
        $p2 = (new CloudPhoto())->setDescription('Stratus bas sur Paris')->setBox($boxA);
        
        $manager->persist($p1);
        $manager->persist($p2);

        $manager->flush();
    }
}
