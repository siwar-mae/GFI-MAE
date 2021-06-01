<?php

namespace App\DataFixtures;

use App\Entity\Thumbnail;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('Flen.Foulen@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFullName('Flen Ben Foulen');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->setAddress('Ariana');
        $thumbnail1 = $manager->getRepository(Thumbnail::class)->findBy(['link' => 'img/ui-divya.jpg'])[0];
        $user->setThumbnail($thumbnail1);
        $user->setToken(md5(uniqid()));
        $user->setLocale('en');
        $manager->persist($user);
        $user2 = new User();
        $user2->setEmail('siwbouss@gmail.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setFullName('Siwar Bousselmi');
        $user2->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user2->setAddress('Tunis');
        $thumbnail2 = $manager->getRepository(Thumbnail::class)->findBy(['link' => 'img/avatar.png'])[0];
        $user2->setThumbnail($thumbnail2);
        $user2->setToken(md5(uniqid()));
        $user2->setLocale('en');
        $manager->persist($user2);
        $manager->flush();
    }
}
