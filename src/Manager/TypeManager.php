<?php


namespace App\Manager;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;

class TypeManager
{
    /**
     * @var TypeRepository|ObjectRepository
     */
    protected $repository;
    /**
     * @var Security
     */
    protected $security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security)
    {
        $this->repository = $entityManager->getRepository(Type::class);
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function getData(){
        return $this->repository->findAllArrayResult();
    }

    /**
     * @param $type
     * @return bool
     *
     * @throws \Exception
     */
    public function post($description)
    {
        $type = new Type();
        $type->setDescription($description);
        $this->entityManager->persist($type);
        $this->entityManager->flush();

        return true;
    }
}
