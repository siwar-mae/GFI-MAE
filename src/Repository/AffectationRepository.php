<?php

namespace App\Repository;

use App\Entity\Affectation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Affectation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affectation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affectation[]    findAll()
 * @method Affectation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffectationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affectation::class);
    }

    // /**
    //  * @return Affectation[] Returns an array of Affectation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Affectation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByUserAndDate($user, $date)
    {
        return $this->createQueryBuilder('b')
            ->where('b.user = :user')
            ->andWhere('b.date = :date')
            ->setParameter('user', $user)
            ->setParameter('date', $date)
            ->getQuery()
            ->getArrayResult();
    }

    public function findAllArrayResult()
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('u')
            ->from(Affectation::class, 'u');

        return $qb->getQuery()->getArrayResult();
    }

    public function findByUser($user)
    {
        if ('' !== $user) {
            return $this->createQueryBuilder('b')
                ->where('b.user = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getArrayResult();
        } else {
            return $this->createQueryBuilder('b')
                ->getQuery()
                ->getArrayResult();
        }
    }
}
