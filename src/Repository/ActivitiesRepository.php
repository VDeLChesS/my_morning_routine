<?php

namespace App\Repository;

use App\Entity\Activities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activities>
 */
class ActivitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activities::class);
    }



    /**
    * @return Activities[] Returns an array of Activities objects
    */
    public function findByCategory($value): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.category = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findCompletedActivities($value): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.completed = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function countCompletedActivities($value): int
    {
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->andWhere('a.completed = 1')
            ->setParameter('1', $value)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
