<?php

namespace App\Repository;

use App\Entity\MemberEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MemberEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberEvent[]    findAll()
 * @method MemberEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberEvent::class);
    }

    // /**
    //  * @return MemberEvent[] Returns an array of MemberEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MemberEvent
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
