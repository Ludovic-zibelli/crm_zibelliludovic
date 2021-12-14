<?php

namespace App\Repository;

use App\Entity\Projet;
use App\Entity\ProjetsRecheche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);
    }

    /**
     * @return Projet[] Returns an array of Projet objects
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.statut = false')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Projet[] Returns an array of Projet objects
     */
    public function findLatestStatut(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.statut = true')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getNbCours()
    {

        return $this->createQueryBuilder('l')
            ->andWhere('l.statut = false')
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();


    }

    public function getNbTerminer()
    {

        return $this->createQueryBuilder('l')
            ->andWhere('l.statut = true')
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();


    }

    public function getNbResultat($resultat)
    {

        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :id')
            ->setParameter('id', $resultat->getID())
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();

    }


    /**
     * @param ProjetsRecheche $recherche
     * @return Projet[] Returns an array of Projet objects
     */
    public function findSearch(ProjetsRecheche $recherche): array
    {

        $qery = $this->createQueryBuilder('s');

        if($recherche->getNomProjet())
        {
            $qery = $qery
                ->andWhere('s.nom = :nom')
                ->setParameter('nom', $recherche->getNomProjet());
        }
        if($recherche->getSociete())
        {

            $qery = $qery
                ->leftJoin('s.societe', 'g')
                ->andWhere('g.nom = :societe')
                ->setParameter('societe',$recherche->getSociete());
        }
        if($recherche->getNumeroProjet())
        {
            $qery = $qery
                ->andWhere('s.id = :id')
                ->setParameter('id', $recherche->getNumeroProjet());
        }

        return $qery
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return Projet[] Returns an array of Projet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Projet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
