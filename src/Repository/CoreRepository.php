<?php

namespace App\Repository;

use App\Entity\MappedSuperclassBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MappedSuperclassBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method MappedSuperclassBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method MappedSuperclassBase[]    findAll()
 * @method MappedSuperclassBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MappedSuperclassBase::class);
    }

    // /**
    //  * @return MappedSuperclassBase[] Returns an array of MappedSuperclassBase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MappedSuperclassBase
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
