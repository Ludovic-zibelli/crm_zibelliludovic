<?php

namespace App\Repository;

use App\Entity\TableauDeBord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TableauDeBord|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableauDeBord|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableauDeBord[]    findAll()
 * @method TableauDeBord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableauDeBordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableauDeBord::class);
    }

    /**
     * @return TableauDeBord[] Returns an array of TableauDeBord objects
     */
     public function findLatest(): array
        {
            return $this->createQueryBuilder('a')

                ->orderBy('a.id', 'DESC')
                ->setMaxResults(5)
                ->getQuery()
                ->getResult()
                ;
        }

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
    public function findOneBySomeField($value): ?TableauDeBord
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
