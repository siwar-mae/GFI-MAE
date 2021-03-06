<?php

namespace App\Repository;

use App\Entity\Intervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Intervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervention[]    findAll()
 * @method Intervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intervention::class);
    }

//     /**
//      * @return Intervention[] Returns an array of Intervention objects
//      */
//
//    public function findByExampleField($value)
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getArrayResult()
//        ;
//    }

    /*
    public function findOneBySomeField($value): ?Intervention
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByUser($user)
    {
        if ('' !== $user) {
            return $this->createQueryBuilder('b')
                ->join('b.agency', 'c')->addSelect('c')
                ->where('b.intervenant = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getArrayResult();
        } else {
            return $this->createQueryBuilder('b')
                ->join('b.agency', 'c')->addSelect('c')
                ->getQuery()
                ->getArrayResult();
        }
    }

    public function countByAgency(){
        return $this->createQueryBuilder('i')
            ->select('count(i) as total')
            ->join('i.agency', 'a')->addSelect('a.name')
            ->groupBy('i.agency')
            ->getQuery()
            ->getResult();
    }
}
