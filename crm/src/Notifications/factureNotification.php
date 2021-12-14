<?php

namespace App\Notifications;


use App\Repository\FacturesRepository;
use CMEN\GoogleChartsBundle\CMENGoogleChartsBundle;

class factureNotification
{
    private $facturesRepository;

    function __construct(FacturesRepository $facturesRepository)
    {
        $this->facturesRepository = $facturesRepository;
    }


    function totalFacturePayer()
    {
        $annee = $this->recupAnnee();
        $factures = $this->facturesRepository->findFacturePayer($annee);
        $total = 0 ;
        foreach ($factures as $facture)
        {
            $total += $facture->getMontantFacture();
        }
        return $total;
    }

    function totalFactureNonPayer()
    {
        $annee = $this->recupAnnee();
        $factures = $this->facturesRepository->findFactureNonPayer($annee);
        $total = 0 ;
        foreach ($factures as $facture)
        {
            $total += $facture->getMontantFacture();
        }
        return $total;
    }

    function totalFacturePayerN1()
    {
        $annee = $this->recupAnnee() - 1;
        $factures = $this->facturesRepository->findFacturePayer($annee);
        $total = 0 ;
        foreach ($factures as $facture)
        {
            $total += $facture->getMontantFacture();
        }
        return $total;
    }

    function totalFactureNonPayerN1()
    {
        $annee = $this->recupAnnee() - 1;
        $factures = $this->facturesRepository->findFactureNonPayer($annee);
        $total = 0 ;
        foreach ($factures as $facture)
        {
            $total += $facture->getMontantFacture();
        }
        return $total;
    }

    function evolutionCa()
    {
        $anneeCours = $this->totalFacturePayer();
        $anneeMoin1 = $this->totalFacturePayerN1();

        if($anneeMoin1 == 0)
        {
            $taux = 0;

        }else
        {
            $a = $anneeCours-$anneeMoin1;
            $b = $a / $anneeMoin1;
            $taux = $b * 100;
        }

        return $taux;
    }

    function recupAnnee()
    {
        $date = new \DateTime('now');
        $dateFormat = $date->format("Y");

        return $dateFormat;
    }

    //Création d'un graphique pour le chiffre d'affaire
    function graphCA()
    {
        $anneeN1 = $this->recupAnnee() - 1;
        $graph = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();

        $data = [
            ['Chiffre d\'affaire', 'Année -1' , 'Année en cours'],
            [$this->recupAnnee(),$this->totalFacturePayerN1(),$this->totalFacturePayer()]
        ];

        $graph->getData()->setArrayToDataTable($data);


        return $graph;



    }
}
