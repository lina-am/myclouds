<?php

namespace App\DataFixtures;

use App\Entity\CloudBox;
use App\Entity\CloudPhoto;
use App\Entity\Gallery;
use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // --- CloudBoxes (Inventaires)
        $boxA = (new CloudBox())->setDescription('Boîte A : Nuages stratifiés');
        $boxB = (new CloudBox())->setDescription('Boîte B : Cumulus');
        $manager->persist($boxA);
        $manager->persist($boxB);

        // --- Photos
        $p1 = (new CloudPhoto())->setDescription('Stratus bas sur Paris')->setBox($boxA);
        $p2 = (new CloudPhoto())->setDescription('Cumulus au coucher du soleil')->setBox($boxB);
        $p3 = (new CloudPhoto())->setDescription('Altocumulus au dessus du lac')->setBox($boxB);
        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        // Un créateur (Member)
        $m = new Member();
        $m->setEmail('demo@localhost');
        $m->setPassword($this->hasher->hashPassword($m, '123456'));
        $m->setNom('Démo');
        $manager->persist($m);

        // Galleries
        $g1 = (new Gallery())
            ->setDescription('Galerie Stratiforme')
            ->setPublished(true)
            ->setCreator($m);
        $g1->addPhoto($p1)->addPhoto($p2);   // ⟵ ajoute 2 photos

        $g2 = (new Gallery())
            ->setDescription('Galerie Cumulus')
            ->setPublished(false)
            ->setCreator($m);
        $g2->addPhoto($p2)->addPhoto($p3);   // ⟵ recoupe sur p2

        $manager->persist($g1);
        $manager->persist($g2);

        $manager->flush();
    }
}