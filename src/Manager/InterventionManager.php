<?php


namespace App\Manager;


use App\Entity\Agency;
use App\Entity\Intervention;
use App\Entity\User;
use App\Repository\AgencyRepository;
use App\Repository\InterventionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;
use \DateTime;

class InterventionManager
{

    /**
     * @var InterventionRepository|ObjectRepository
     */
    protected $repository;
    /**
     * @var AgencyRepository|ObjectRepository
     */
    protected $agencyRepository;
    /**
     * @var Security
     */
    protected $security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security)
    {
        $this->repository = $entityManager->getRepository(Intervention::class);
        $this->agencyRepository = $entityManager->getRepository(Agency::class);
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $arrayIntervention
     * @return bool
     *
     * @throws \Exception
     */
    public function post($arrayIntervention)
    {
        $intervention = new Intervention();
        $pos = strpos($arrayIntervention['structure'], '(');
        $arrayIntervention['structure'] = substr($arrayIntervention['structure'], $pos + 1 , 3);
        $agency = $this->agencyRepository->findOneBy(array('code' => $arrayIntervention['structure']));
        $intervention->setAgency($agency);
        $intervention->setNumber($arrayIntervention['number']);
        $intervention->setStartDate(new DateTime($arrayIntervention['startDate']));
        $intervention->setIntervenant($this->security->getUser());
        $intervention->setObservation($arrayIntervention['observation']);
        $this->entityManager->persist($intervention);
        $this->entityManager->flush();

        return true;
    }

    public function getData(){
        $interventionsByUser = $this->repository->findAllByUser($this->security->getUser());
        $interventions = $this->repository->findAllByUser('');
        return ['interventionsByUser' => $interventionsByUser, 'interventions' => $interventions];
    }
}