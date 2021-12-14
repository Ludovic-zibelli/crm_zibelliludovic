<?php

namespace App\Repository;

use App\Entity\ClientRecherche;
use App\Entity\MiniMaxi;
use App\Entity\Societes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Societes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Societes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Societes[]    findAll()
 * @method Societes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocietesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Societes::class);
    }

    /**
     * @return Societes[]
     */
    public function findSocietes()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Societes[] Returns an array of Projet objects
     */
    public function findIdSociete(): array
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
     * @return Societes[] Returns an array of Projet objects
     */
    public function findSearch(ClientRecherche $recherche): array
    {
        $qery = $this->createQueryBuilder('s');

            if($recherche->getNumeroClient())
            {
                    $qery = $qery
                        ->andWhere('s.id = :nclient')
                        ->setParameter('nclient', $recherche->getNumeroClient());
            }

            if($recherche->getNomSociete())
            {
                $qery = $qery
                    ->andWhere('s.nom = :societe')
                    ->setParameter('societe', $recherche->getNomSociete());
            }


        return $qery
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return Societes[] Returns an array of Societes objects
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
    public function findOneBySomeField($value): ?Societes
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
