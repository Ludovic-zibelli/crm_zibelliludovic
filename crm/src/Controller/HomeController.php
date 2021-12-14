<?php

namespace App\Controller;

use App\Form\CalendrierMaintenanceType;
use App\Notifications\factureNotification;
use App\Repository\CalendrierMaintenanceRepository;
use App\Repository\FacturesRepository;
use App\Repository\ProjetRepository;
use App\Repository\TableauDeBordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class HomeController extends AbstractController
{

    private $em;

    private $projetRepository;

    private $tableauDeBord;

    private $calendrierMaintenanceRepository;

    private $facturesRepository;

    public function __construct(ProjetRepository $projetRepository, TableauDeBordRepository $tableauDeBord, EntityManagerInterface $em, CalendrierMaintenanceRepository $calendrierMaintenanceRepository, FacturesRepository $facturesRepository)
    {
        $this->em = $em;
        $this->projetRepository = $projetRepository;
        $this->tableauDeBord = $tableauDeBord;
        $this->calendrierMaintenanceRepository = $calendrierMaintenanceRepository;
        $this->facturesRepository = $facturesRepository;
    }

    /**
     * @Route("/home", name="home")
     * @return Response
     */
    public function home()
    {
        return $this->render('CRM/home.html.twig');
    }

    /**
     * @Route("/index", name="index")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function index(factureNotification $factureNotification)
    {
        $projet = $this->projetRepository->findLatest();
        $projetTerminer = $this->projetRepository->findLatestStatut();
        $rapports = $this->tableauDeBord->findLatest();
        dump($projetTerminer);
        $listeMaintenance = $this->calendrierMaintenanceRepository->findAll();
        $planig = [];

        foreach ($listeMaintenance as $liste)
        {
            $planig[] = [
                'id' => $liste->getId(),
                'title' => $liste->getTitle(),
                'start' => $liste->getStart()->format('Y-m-d H:m:s'),
                'end' => $liste->getEnd()->format('Y-m-d H:m:s'),
                'description' => $liste->getDescription(),
                'backgroundColor' => $liste->getBackgroundColor(),
                'borderColor' => $liste->getBorderColor(),
                'textColor' => $liste->getTextColor(),
            ];
        }

        $totalPayer = $factureNotification->totalFacturePayer();
        $totalNonPayer = $factureNotification->totalFactureNonPayer();
        $taux = $factureNotification->evolutionCa();
        $totalNmoin1 = $factureNotification->totalFacturePayerN1();
        $anneeCour = $factureNotification->recupAnnee();
        $nbCours = $this->projetRepository->getNbCours();
        $nbTerminer = $this->projetRepository->getNbTerminer();
        $nbMaintenance = $this->calendrierMaintenanceRepository->getNbMaintenance();


        $data = json_encode($planig);

        return $this->render('CRM/index.html.twig', [
            'projet' => $projet,
            'projetTerminer'=> $projetTerminer,
            'dataMaintenance' => $data,
            'totalPayer' => $totalPayer,
            'totalNonPayer' => $totalNonPayer,
            'taux' => $taux,
            'totalN1' => $totalNmoin1,
            'annee' => $anneeCour,
            'nbcours' => $nbCours,
            'nbterminer' => $nbTerminer,
            'nbmaintenance' => $nbMaintenance

        ]);
    }


}

