<?php


use App\Entity\Intervention;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class IndexService
{
//    /**
//     * @var EntityManagerInterface
//     */
//    protected $entityManager;
//
//    /**
//     * IndexService constructor.
//     */
//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }
//
//    function addAction (Request $request){
//        $intervention = new Intervention();
//        $intervention->setAgency($request->get('agency'));
//        $intervention->setNumber($request->get('number'));
//        $intervention->setEndDate($request->get('endDate'));
//        $intervention->setStartDate($request->get('startDate'));
//        $intervention->setIntervenant($request->get('user'));
//        $intervention->setObservation($request->get('observation'));
//        $this->entityManager->persist($intervention);
//        $this->entityManager->flush();
//    }
}
