<?php

namespace App\Repository;

use App\Entity\FactureRecherche;
use App\Entity\Factures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Factures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Factures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Factures[]    findAll()
 * @method Factures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Factures::class);
    }

    /**
     * @return Factures[] Returns an array of Projet objects
     */
    public function findFacturePayer($annee): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.payer = false')
            ->andWhere('a.facture_devis = false')
            ->setParameter('annee', $annee)
            ->andWhere('a.annee_exercice = :annee')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Factures[] Returns an array of Projet objects
     */
    public function findFactureNonPayer($annee): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.payer = true')
            ->andWhere('a.facture_devis = false')
            ->setParameter('annee' , $annee)
            ->andWhere('a.annee_exercice = :annee')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Factures[] Returns an array of Projet objects
     */
    public function findFactureNonPayerAll(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.payer = true')
            ->andWhere('a.facture_devis = false')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Factures[] Returns an array of Projet objects
     */
    public function findFacturePayerAll(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.payer = false')
            ->andWhere('a.facture_devis = false')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Factures[] Returns an array of Projet objects
     */
    public function findDevis(): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.facture_devis = true')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getNb()
    {

        return $this->createQueryBuilder('l')
            ->andWhere('l.payer = false')
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();

    }

    /**
     * @param FactureRecherche $factureRecherche
     * @return Factures[] Returns an array of Projet objects
     */
    public function findSearch(FactureRecherche $factureRecherche): array
    {

        $qery = $this->createQueryBuilder('s');

        if($factureRecherche->getNumeroFacture())
        {
            $qery = $qery
                ->andWhere('s.numero_de_facture = :numero')
                ->setParameter('numero', $factureRecherche->getNumeroFacture())
                ->andWhere('s.facture_devis = :devisFacture')
                ->setParameter('devisFacture', $factureRecherche->getFactureDevis());
        }

        if($factureRecherche->getProjet())
        {
            $qery = $qery
                ->leftJoin('s.projet', 'g')
                ->andWhere('g.nom = :projet')
                ->setParameter('projet', $factureRecherche->getProjet())
                ->andWhere('s.facture_devis = :devisFacture')
                ->setParameter('devisFacture', $factureRecherche->getFactureDevis());
        }


        return $qery
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return Factures[] Returns an array of Factures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Factures
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
