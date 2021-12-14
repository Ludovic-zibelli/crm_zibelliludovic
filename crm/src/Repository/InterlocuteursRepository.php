<?php

namespace App\Repository;

use App\Entity\ContactsRecherche;
use App\Entity\Interlocuteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Interlocuteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Interlocuteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Interlocuteurs[]    findAll()
 * @method Interlocuteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterlocuteursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Interlocuteurs::class);
    }

    /**
     * @param ContactsRecherche $recherche
     * @return Interlocuteurs[] Returns an array of Projet objects
     */
    public function findSearch(ContactsRecherche $recherche): array
    {
        $qery = $this->createQueryBuilder('s');

        if($recherche->getNom())
        {
            $qery = $qery
                ->andWhere('s.nom = :nom')
                ->setParameter('nom', $recherche->getNom());
        }

        if($recherche->getSociete())
        {
            $qery = $qery
                ->andWhere('s.societe = :societe')
                ->setParameter('societe', $recherche->getSociete());
        }

        return $qery
            ->getQuery()
            ->getResult();

    }

    // /**
    //  * @return Interlocuteurs[] Returns an array of Interlocuteurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Interlocuteurs
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
