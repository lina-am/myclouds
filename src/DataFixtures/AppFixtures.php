<?php

namespace App\DataFixtures;

use App\Entity\CloudBox;
use App\Entity\CloudPhoto;
use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /** @return \Generator<array{0:string,1:string,2:string}> */
    private function membersGenerator(): \Generator
    {
        yield ['olivier@localhost', '123456', 'Olivier'];
        yield ['slash@localhost',   '123456', 'Slash'];
    }

    public function load(ObjectManager $manager): void
    {
        // Données démo CloudBox / CloudPhoto (déjà présentes dans ton projet)
        $boxA = (new CloudBox())->setDescription('Boîte A : Nuages stratifiés');
        $boxB = (new CloudBox())->setDescription('Boîte B : Cumulus');
        $manager->persist($boxA);
        $manager->persist($boxB);

        $manager->persist((new CloudPhoto())->setDescription('Cumulus au coucher du soleil')->setBox($boxB));
        $manager->persist((new CloudPhoto())->setDescription('Stratus bas sur Paris')->setBox($boxA));

        // Membres
        foreach ($this->membersGenerator() as [$email, $plainPassword, $nom]) {
            $user = new Member();
            $user->setEmail($email);
            $user->setNom($nom); // requis car not null

            $hashed = $this->hasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashed);

            $manager->persist($user);
        }

        $manager->flush();
    }
}