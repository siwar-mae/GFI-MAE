<?php

namespace App\Manager\Backend;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;

class UserManager
{
    /**
     * @var UserRepository|ObjectRepository
     */
    protected $repository;
    /**
     * @var Security
     */
    protected $security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security)
    {
        $this->repository = $entityManager->getRepository(User::class);
        $this->security = $security;
        $this->entityManager = $entityManager;
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
        $user->setPassword('test');
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}
