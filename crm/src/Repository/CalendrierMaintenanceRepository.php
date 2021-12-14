<?php

namespace App\Repository;

use App\Entity\CalendrierMaintenance;
use App\Entity\MaintenanceRecherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CalendrierMaintenance|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalendrierMaintenance|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalendrierMaintenance[]    findAll()
 * @method CalendrierMaintenance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendrierMaintenanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendrierMaintenance::class);
    }

    public function getNbMaintenance()
    {

        return $this->createQueryBuilder('l')
            ->andWhere('l.active = true')
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return CalendrierMaintenance[] Returns an array of Projet objects
     */
    public function findPlanActive(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.active = true')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return CalendrierMaintenance[] Returns an array of Projet objects
     */
    public function findPlanNonActive(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.active = false')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param MaintenanceRecherche $recherche
     * @return CalendrierMaintenance[] Returns an array of Projet objects
     */
    public function findSearch(MaintenanceRecherche $recherche): array
    {

        $qery = $this->createQueryBuilder('s');

        if($recherche->getProjet())
        {
            $qery = $qery
                ->leftJoin('s.projet', 'g')
                ->andWhere('g.nom = :nom')
                ->setParameter('nom', $recherche->getProjet());
        }

        return $qery
            ->getQuery()
            ->getResult();

    }

    // /**
    //  * @return CalendrierMaintenance[] Returns an array of CalendrierMaintenance objects
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
    public function findOneBySomeField($value): ?CalendrierMaintenance
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
