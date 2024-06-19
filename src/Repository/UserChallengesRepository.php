<?php

namespace App\Repository;

use App\Entity\UserChallenges;
use App\Repository\ChallengesRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserChallenges>
 */
class UserChallengesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChallenges::class);
    }

    /**
    * @return UserChallenges[] Returns an array of UserChallenges objects
    */
    public function findCompletedChallenges($value): array
    {
        return $this->createQueryBuilder('uc')
            ->andWhere('uc.is_completed = :val')
            ->setParameter('val', $value)
            ->orderBy('uc.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function countCompletedChallenges($value): int
    {
        return $this->createQueryBuilder('uc')
            ->select('count(uc.id)')
            ->andWhere('uc.is_completed = 1')
            ->setParameter('1', $value)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function countTotalPointsByUserChallenges(UserChallenges $userChallenges, ChallengesRepository $challenges): int
    {
        $totalPoints = 0;
        foreach ($userChallenges as $userChallenge) {
            $challenge = $this->$challenges->createQueryBuilder('Challenges', 'c')
                ->where('c.id = :id')
                ->setParameter('id', $userChallenge->getChallenge()->getId())
                ->getQuery()
                ->getOneOrNullResult();
            $totalPoints += $challenge->getPoints();
        }
        return $totalPoints;
    }

    //    public function findOneBySomeField($value): ?UserChallenges
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
