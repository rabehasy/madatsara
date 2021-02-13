<?php

namespace App\Repository;

use App\Entity\KeywordSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeywordSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeywordSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeywordSearch[]    findAll()
 * @method KeywordSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeywordSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeywordSearch::class);
    }

    // /**
    //  * @return KeywordSearch[] Returns an array of KeywordSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KeywordSearch
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
