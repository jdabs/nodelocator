<?php

namespace App\Repository;

use App\Entity\Topnodes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Topnodes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topnodes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topnodes[]    findAll()
 * @method Topnodes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopnodesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topnodes::class);
    }

    // /**
    //  * @return Topnodes[] Returns an array of Topnodes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Topnodes
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
