<?php

namespace App\Manager;

use App\Entity\Agency;
use App\Entity\Intervention;
use App\Repository\AgencyRepository;
use App\Repository\InterventionRepository;
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
     * @var InterventionRepository|ObjectRepository
     */
    protected $interventionRepository;
    /**
     * @var Security
     */
    protected $security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security)
    {
        $this->repository = $entityManager->getRepository(Agency::class);
        $this->interventionRepository = $entityManager->getRepository(Intervention::class);
        $this->security = $security;
    }

    public function getData(): array
    {
        $all = [];
        $agencies = $this->repository->findAllArrayResult();
        $count = $this->interventionRepository->countByAgency();
        foreach ($agencies as $agency){
            foreach ($count as $item){
                if($agency['name'] === $item['name']){
                    $agency['percent'] = $item['total'];
                }
            }
            array_push($agencies,$agency);
            if(count($agency) === 5){
                array_push($all, $agency);
            }
        }
        return $all;
    }
}
