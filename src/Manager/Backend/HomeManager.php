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

class HomeManager
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
}
