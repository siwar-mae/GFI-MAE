<?php


namespace App\Manager;

use App\Entity\Agency;
use App\Entity\Equipment;
use App\Repository\AgencyRepository;
use App\Repository\EquipmentRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;

class EquipementManager
{
    /**
     * @var EquipmentRepository|ObjectRepository
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
        $this->repository = $entityManager->getRepository(Equipment::class);
        $this->agencyRepository = $entityManager->getRepository(Agency::class);
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function getData($code){
        $pos = strpos($code, '(');
        $code = substr($code, $pos + 1 , 3);
        return $this->repository->findAllArrayResult($code);
    }

    /**
     * @param $arrayEquipement
     * @return bool
     *
     * @throws \Exception
     */
    public function post($arrayEquipement)
    {
        $equipement = new Equipment();
        $pos = strpos($arrayEquipement['agency'], '(');
        $arrayEquipement['agency'] = substr($arrayEquipement['agency'], $pos + 1 , 3);
        $agency = $this->agencyRepository->findOneBy(array('code' => $arrayEquipement['agency']));
        $equipement->setAgency($agency);
        $equipement->setDesignation($arrayEquipement['designation']);
        $equipement->setNature($arrayEquipement['nature']);
        $equipement->setPrice($arrayEquipement['price']);
        $equipement->setReference($arrayEquipement['ref']);
        $this->entityManager->persist($equipement);
        $this->entityManager->flush();

        return true;
    }

}
