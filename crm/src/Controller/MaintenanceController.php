<?php

namespace App\Controller;

use App\Entity\CalendrierMaintenance;
use App\Entity\MaintenanceRecherche;
use App\Form\CalendrierMaintenanceType;
use App\Form\MaintenanceRechercheType;
use App\Repository\CalendrierMaintenanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaintenanceController extends AbstractController
{
    private $em;

    private $calendrierMaintenanceRepository;

    public function __construct(EntityManagerInterface $em, CalendrierMaintenanceRepository $calendrierMaintenanceRepository)
    {
        $this->em = $em;
        $this->calendrierMaintenanceRepository = $calendrierMaintenanceRepository;
    }

    /**
     * @Route("/index/maintenance", name="maintenance")
     *
     * @return Response
     * @param Request $request
     */
    public function tdbMaintenace(Request $request)
    {
        $planMaintenance = new CalendrierMaintenance();
        $recherche = new MaintenanceRecherche();
        $form = $this->createForm(CalendrierMaintenanceType::class, $planMaintenance);
        $form_recherche = $this->createForm(MaintenanceRechercheType::class, $recherche);
        $form->handleRequest($request);
        $form_recherche->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($planMaintenance);
            $this->em->flush();
            $this->addFlash('success', 'Nouveau plan de maintenance ajouter');
            return $this->redirectToRoute('maintenance');
        }
        if($form_recherche->isSubmitted() && $form_recherche->isValid())
        {

            $resultat = $this->calendrierMaintenanceRepository->findSearch($recherche);
            return $this->render('CRM/maintenance/listemaintenance.html.twig',[
                'listes' => $resultat
            ]);
        }
        $listeMaintenance = $this->calendrierMaintenanceRepository->findAll();
        $resultatsActive = $this->calendrierMaintenanceRepository->findPlanActive();
        $resultatsNonActive = $this->calendrierMaintenanceRepository->findPlanNonActive();
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
        $data = json_encode($planig);
        return $this->render('CRM/maintenance/tdb_maintenance.html.twig',[
            'form' => $form->createView(),
            'listeMaintenance' => $listeMaintenance,
            'datacalendrier' => $data,
            'resultatActive' => $resultatsActive,
            'resultatNonActive' => $resultatsNonActive,
            'form_recherche' => $form_recherche->createView()
        ]);
    }

    /**
     * @Route("/index/editmaintenance/{id}", name="editmaintenance" , methods="GET|POST")
     *
     * @param Request $request
     * @param CalendrierMaintenance $maintenance
     * @return Response
     */
    public function editMaintenance(Request $request, CalendrierMaintenance $maintenance)
    {
        $form = $this->createForm(CalendrierMaintenanceType::class, $maintenance);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Plan de maintenance modifier avec succès');
            return $this->redirectToRoute('maintenance');
        }
        return $this->render('CRM/maintenance/editmaintenance.html.twig',[
            'societe' => $maintenance,
            'form' => $form->createView()
        ]);

    }

    /**
     *  /**
     * @Route("/index/deletemaintenance/{id}", name="deletemaintenance" , methods="DELETE")
     * @param CalendrierMaintenance $calendrierMaintenance
     * @param Request $request
     * @return Response
     */

    public function deleteMaintenance(CalendrierMaintenance $calendrierMaintenance, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $calendrierMaintenance->getId(), $request->get('_token')))
        {
            $this->em->remove($calendrierMaintenance);
            $this->em->flush();
            $this->addFlash('success', 'Plan de maintenance supprimer avec succès');

        }
        return $this->redirectToRoute('maintenance');
    }

    /**
     * @Route("/index/viewmaintenance/{id}", name="viewmaintenance")
     * @return Response
     * @param Request $request
     */
    public function viewMaintenance($id)
    {
        $plan = $this->calendrierMaintenanceRepository->find($id);
        dump($plan);
        return $this->render('CRM/maintenance/viewmaintenance.html.twig',
            array('plan' => $plan)
        );

    }

    /**
     * @Route("/index/listemaintenance", name="listemaintenance")
     * @return Response
     * @param Request $request
     */
    public function listeMaintenance()
    {
        $recherche = new MaintenanceRecherche();
        $form = $this->createForm(MaintenanceRechercheType::class, $recherche);
        $liste = $this->calendrierMaintenanceRepository->findAll();
        return $this->render('CRM/maintenance/listemaintenance.html.twig',
            array('listes' => $liste)
        );

    }
}