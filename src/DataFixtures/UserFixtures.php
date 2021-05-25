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
        $thumbnail1 = new Thumbnail();
        $thumbnail1->setLink('img/ui-divya.jpg');
        $user->setThumbnail($thumbnail1);
        $manager->persist($user);
        $user2 = new User();
        $user2->setEmail('siwbouss@gmail.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setFullName('Siwar Bousselmi');
        $user2->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user2->setAddress('Tunis');
        $thumbnail2 = new Thumbnail();
        $thumbnail2->setLink('img/avatar.png');
        $user2->setThumbnail($thumbnail2);
        $manager->persist($user2);
        $manager->flush();
    }
}
