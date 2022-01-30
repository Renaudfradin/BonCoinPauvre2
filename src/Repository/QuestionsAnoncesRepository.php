<?php

namespace App\Repository;

use App\Entity\QuestionsAnonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionsAnonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionsAnonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionsAnonces[]    findAll()
 * @method QuestionsAnonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsAnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionsAnonces::class);
    }

    // /**
    //  * @return QuestionsAnonces[] Returns an array of QuestionsAnonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionsAnonces
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
