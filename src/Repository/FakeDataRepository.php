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

    public function findAllGreatherThanAgeDQL($age): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT p FROM App\Entity\FakeData p WHERE p.age > :age"
        )->setParameter('age', $age);

        return $query->getResult();
    }

    public function findAllGreatherThanAgeQueryBuilder($age): array
    {

        $qb = $this->createQueryBuilder('p')
            ->where('p.age > :age')
            ->setParameter('age', $age)
            ->orderBy('p.age', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();

    }

    public function findAllGreatherThanAgeSQL($age): array
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM fake_data WHERE age > :age";

        $stmt = $conn->prepare($sql);

        $stmt->execute(['age' => $age]);

        return $stmt->fetchAll();

    }

    public function findOneByIdJoinedToApi($id)
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT p,c 
                FROM App\Entity\Event p 
                INNER JOIN p.api c
                WHERE p.id = :id"
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();

    }
}
