<?php

namespace App\Repository;

use App\Entity\AlertChannel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AlertChannel|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlertChannel|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlertChannel[]    findAll()
 * @method AlertChannel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlertChannelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlertChannel::class);
    }

    // /**
    //  * @return AlertChannel[] Returns an array of AlertChannel objects
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
    public function findOneBySomeField($value): ?AlertChannel
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
