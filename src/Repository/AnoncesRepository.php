<?php

namespace App\Repository;

use App\Entity\Anonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anonces[]    findAll()
 * @method Anonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anonces::class);
    }

    // /**
    //  * @return Anonces[] Returns an array of Anonces objects
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
    public function findOneBySomeField($value): ?Anonces
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
