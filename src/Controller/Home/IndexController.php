<?php

namespace App\Controller\Home;

use App\Entity\Agency;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Intervention;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * IndexService constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/index", name="index")
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $intervention = new Intervention();
        $agency = $this->entityManager->getRepository(Agency::class)->findOneBy(array('code' => $request->get('agency')));
        $intervention->setAgency($agency);
        $intervention->setNumber($request->get('number'));
        $intervention->setEndDate(new \DateTime($request->get('endDate')));
        $intervention->setStartDate(new \DateTime($request->get('startDate')));
        $user = $this->entityManager->getRepository(User::class)->findOneBy(array('fullName' => $request->get('user')));
        $intervention->setIntervenant($user);
        $intervention->setObservation($request->get('observation'));
        $this->entityManager->persist($intervention);
        $this->entityManager->flush();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
