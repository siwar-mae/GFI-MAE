<?php

namespace App\Manager\Backend;

use App\Entity\Thumbnail;
use App\Entity\User;
use App\Repository\ThumbnailRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class UserManager
{
    /**
     * @var UserRepository|ObjectRepository
     */
    protected $repository;
    /**
     * @var ThumbnailRepository|ObjectRepository
     */
    protected $thumbnailRepository;
    /**
     * @var Security
     */
    protected $security;
    private $userPasswordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->repository = $entityManager->getRepository(User::class);
        $this->thumbnailRepository = $entityManager->getRepository(Thumbnail::class);
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $userPasswordEncoder;
    }

    public function getData()
    {
        return $this->repository->findAllArrayResult();
    }

    /**
     * @param $arrayUser
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function post($arrayUser)
    {
        $user = new User();
        $user->setFullName($arrayUser['fullName']);
        $user->setEmail($arrayUser['email']);
        $user->setRoles($arrayUser['roles']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $arrayUser['pwd']));
        $user->setAddress($arrayUser['address']);
        $thumbnail = $this->thumbnailRepository->findBy(['link' => 'img/'.$arrayUser['thumb']]);
        if($thumbnail){
            $user->setThumbnail($thumbnail[0]);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function put($arrayUser){
        $user = $this->repository->find($arrayUser['id']);
        $user->setAddress($arrayUser['address']);
        $user->setEmail($arrayUser['email']);
        $user->setFullName($arrayUser['fullName']);
        $user->setRoles([$arrayUser['role']]);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $arrayUser['pwd']));
        $thumbnail = $this->thumbnailRepository->findBy(['link' => 'img/'.$arrayUser['thumb']]);
        if($thumbnail){
            $user->setThumbnail($thumbnail[0]);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}
