<?php


namespace App\Manager;

use App\Entity\Agency;
use App\Repository\AgencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;

class AgencyManager
{
    /**
     * @var AgencyRepository|ObjectRepository
     */
    protected $repository;
    /**
     * @var Security
     */
    protected $security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security)
    {
        $this->repository = $entityManager->getRepository(Agency::class);
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function getData(){
        return $this->repository->findAllArrayResult();
    }
}
