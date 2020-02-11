<?php

namespace App\Repository;

use App\Entity\FakeData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FakeData|null find($id, $lockMode = null, $lockVersion = null)
 * @method FakeData|null findOneBy(array $criteria, array $orderBy = null)
 * @method FakeData[]    findAll()
 * @method FakeData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FakeDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FakeData::class);
    }

    // /**
    //  * @return FakeData[] Returns an array of FakeData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FakeData
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
