<?php


namespace App\Manager;


use App\Entity\Affectation;
use App\Entity\User;
use App\Repository\AffectationRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;

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
    /**
     * @var Security
     */
    protected $security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security)
    {
        $this->repository = $entityManager->getRepository(Affectation::class);
        $this->userRepository = $entityManager->getRepository(User::class);
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    /**
     * @throws \Exception
     */
    public function post($data){
        $affectation = new Affectation();
        $affectation->setDate(new DateTime($data['date']));
        $user = $this->userRepository->findOneBy(['email' => $data['user']]);
        $affectation->setUser($user->getId());
        $affectations = $this->repository->findAll();
        if($affectations !== []){
            $verify = $this->repository->findByUserAndDate($affectation->getUser(), $affectation->getDate());
            if($verify === []){
                $this->entityManager->persist($affectation);
                $this->entityManager->flush();
                return true;
            }else {
                return false;
            }
        }else{
            $this->entityManager->persist($affectation);
            $this->entityManager->flush();
            return true;
        }
    }

    public function getData()
    {
        $dataByUser = $this->repository->findByUser($this->security->getUser());
        $data = $this->repository->findByUser('');
        return ['dataByUser' => $dataByUser, 'data' => $data];
    }
}