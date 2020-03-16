<?php

namespace App\Repository;

use App\Entity\SubSubCategoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SubSubCategoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubSubCategoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubSubCategoria[]    findAll()
 * @method SubSubCategoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubSubCategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubSubCategoria::class);
    }

    // /**
    //  * @return SubSubCategoria[] Returns an array of SubSubCategoria objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubSubCategoria
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
