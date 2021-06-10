<?php


namespace App\Manager;


use App\Entity\Affectation;
use App\Repository\AffectationRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class AffectationManager
{
    /**
     * @var AffectationRepository|ObjectRepository
     */
    protected $repository;
    /**
     * @var UserRepository|ObjectRepository
     */
    protected $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Affectation::class);
        $this->entityManager = $entityManager;
    }

    public function post($data){
        $affectation = new Affectation();
        $affectation->setDate(new DateTime($data['date']));
        $user = $this->userRepository->findOneBy(['email' => $data['user']]);
        $affectation->setUser($user->getId());
        $this->entityManager->persist($affectation);
        $this->entityManager->flush();

        return true;
    }

}