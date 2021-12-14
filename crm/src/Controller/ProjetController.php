<?php
namespace App\Controller;

use App\Entity\FactureRecherche;
use App\Entity\Factures;
use App\Entity\Fichiers;
use App\Entity\Projet;
use App\Entity\ProjetsRecheche;
use App\Entity\TableauDeBord;
use App\Form\FacturesRechercheType;
use App\Form\FactureType;
use App\Form\FichierType;
use App\Form\ProjetsRechercheType;
use App\Form\ProjetType;
use App\Form\RapportType;
use App\Notifications\factureNotification;
use App\Repository\FacturesRepository;
use App\Repository\InterlocuteursRepository;
use App\Repository\ProjetRepository;
use App\Repository\SocietesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ProjetController extends AbstractController
{
    private $em;

    private $projetRepository;

    private $societesRepository;

    private $interlocuteursRepository;

    private $facturesRepository;

    public function __construct(EntityManagerInterface $em, ProjetRepository $projetRepository, SocietesRepository $societesRepository, InterlocuteursRepository $interlocuteursRepository, FacturesRepository $facturesRepository)
    {
        $this->em = $em ;
        $this->projetRepository = $projetRepository;
        $this->societesRepository = $societesRepository;
        $this->interlocuteursRepository = $interlocuteursRepository;
        $this->facturesRepository = $facturesRepository;
    }

    /**
     * @Route("/index/newprojet", name="newprojet")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     */
    public function newProjet(Request $request)
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($projet);
            $this->em->flush();
            $this->addFlash('success', 'Nouveau projet ajouter');
            return $this->redirectToRoute('newprojet');
        }
        return $this->render('CRM/Projet/newProjet.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/index/listeprojet", name="listeprojet")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     */
    public function listeProjet(Request $request)
    {
        $searchProjet = new ProjetsRecheche();
        $form = $this->createForm(ProjetsRechercheType::class, $searchProjet);
        $listeprojet = $this->projetRepository->findAll();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $resultats = $this->projetRepository->findSearch($searchProjet);
            $qd = count($resultats);
            return $this->render('CRM/projet/listeprojet.html.twig',[
                'form' => $form->createView(),
                'listeprojet' => $resultats,
                'qd' => $qd
            ]);
        }
        dump($listeprojet);
        return $this->render('CRM/projet/listeprojet.html.twig',[
            'listeprojet' => $listeprojet,
            'form' => $form->createView(),
            'qd' => 0
        ]);
    }

    /**
     * @Route("/index/tdbprojet/{id}", name="tdbprojet")
     * @IsGranted("ROLE_ADMIN")
     * @param $id
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function tdbProjet($id, Request $request, UserRepository $userRepository)
    {
        $fichier = new Fichiers();
        $rapport = new TableauDeBord();
        $facture = new Factures();
        $from_fichier = $this->createForm(FichierType::class, $fichier);
        $from_rapport = $this->createForm(RapportType::class, $rapport);
        $from_facture = $this->createForm(FactureType::class, $facture);
        $projet = $this->projetRepository->find($id);
        $userId = $this->getUser();
        $user = $userRepository->find($userId);


        dump($projet);
        $from_fichier->handleRequest($request);
        $from_rapport->handleRequest($request);
        $from_facture->handleRequest($request);

        if($from_fichier->isSubmitted() && $from_fichier->isValid())
        {
            $fichier->setProjet($projet);
            $this->em->persist($fichier);
            $this->em->flush();
            $this->addFlash('success', 'Fichier ajouter avec succes');
        }

        if($from_rapport->isSubmitted() && $from_rapport->isValid())
        {

            $rapport->setUser($user);
            $rapport->setProjet($projet);
            $this->em->persist($rapport);
            $this->em->flush();
            $this->addFlash('success', 'Rapport ajouter avec succes');
        }

        if($from_facture->isSubmitted() && $from_facture->isValid())
        {
            $facture->setProjet($projet);
            $this->em->persist($facture);
            $this->em->flush();
            $this->addFlash('success', 'Facture ajouter avec succes');
        }

        return $this->render('CRM/Projet/tdb_projet.html.twig',[
            'projet' => $projet,
            'form_fichier' => $from_fichier->createView(),
            'form_rapport' => $from_rapport->createView(),
            'form_facture' => $from_facture->createView(),
            'user' => $user

        ]);

    }

    /**
     * @Route("/index/editprojet/{id}", name="editprojet" , methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param Projet $projet
     */
    public function editClient(Request $request, Projet $projet)
    {
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $projet->setDateModification(new \DateTime());
            $this->em->flush();
            $this->addFlash('success', 'Client modifier avec succès');
            return $this->redirectToRoute('listeprojet');
        }
        return $this->render('CRM/Projet/editprojet.html.twig',[
            'projet' => $projet,
            'form' => $form->createView()
        ]);

    }


    //Gestion rapport
    //Modifier rapport
    /**
     * @Route("/index/editrapport/{id}", name="editrapport" , methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param TableauDeBord $tableauDeBord
     */
    public function editRapport(Request $request, TableauDeBord $tableauDeBord)
    {
        $form = $this->createForm(RapportType::class, $tableauDeBord);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $id = $tableauDeBord->getProjet()->getId();
            $tableauDeBord->setDateModification(new \DateTime());
            $this->em->flush();
            $this->addFlash('success', 'Rapport modifier avec succès');
            return $this->redirectToRoute('tdbprojet', ['id' => $id]);
        }
        dump($tableauDeBord);
        return $this->render('CRM/Projet/editrapport.html.twig',[
            'tableaubord' => $tableauDeBord,
            'form' => $form->createView()
        ]);

    }

    //Suppression de rapport
    /**
     *  /**
     * @Route("/index/deleterapport/{id}", name="deleterapport" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param TableauDeBord $tableauDeBord
     */

    public function deleteRapport(TableauDeBord $tableauDeBord, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $tableauDeBord->getId(), $request->get('_token')))
        {
            $id = $tableauDeBord->getProjet()->getId();
            $this->em->remove($tableauDeBord);
            $this->em->flush();
            $this->addFlash('success', 'Rapport supprimer avec succès');
            return $this->redirectToRoute('tdbprojet', ['id' => $id]);

        }
        return $this->redirectToRoute('listeclient');
    }

    //Gestion Factures
    /**
     * @Route("/index/editfacture/{id}", name="editfacture")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     */
    public function editFacture($id, Request $request)
    {
        $facture = $this->facturesRepository->find($id);
        $nomProjet = $facture->getProjet()->getNom();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $id = $facture->getProjet()->getId();
            $this->em->flush();
            $this->addFlash('success', 'Facture modifier avec succès');
            return $this->redirectToRoute('tdbprojet', ['id' => $id]);
        }
        $id = $facture->getProjet()->getId();
        return $this->render('CRM/projet/editfacture.html.twig',[
            'form' => $form->createView(),
            'id' => $id,
            'nom' => $nomProjet

        ]);

    }

    //Suppresion des fichiers
    /**
     *  /**
     * @Route("/index/deletefichier/{id}", name="deletefichier" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param Fichiers $fichiers
     */

    public function deleteFichier(Fichiers $fichiers, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $fichiers->getId(), $request->get('_token')))
        {
            $id = $fichiers->getProjet()->getId();
            $this->em->remove($fichiers);
            $this->em->flush();
            $this->addFlash('success', 'Fichier supprimer avec succès');
            return $this->redirectToRoute('tdbprojet', ['id' => $id]);

        }
        return $this->redirectToRoute('listeclient');
    }

    //Gestion factures

    /**
     * @Route("/index/factures", name="factures")
     * @IsGranted("ROLE_ADMIN")
     * @param factureNotification $factureNotification
     * @param Request $request
     * @return Response
     */
    public function Factures(factureNotification $factureNotification, Request $request)
    {
        $rechercheFacture = new FactureRecherche();
        //Gestion de l'affichage
        $totalPayer = $factureNotification->totalFacturePayer();
        $totalNonPayer = $factureNotification->totalFactureNonPayer();
        $taux = $factureNotification->evolutionCa();
        $totalNmoin1 = $factureNotification->totalFacturePayerN1();
        $anneeCour = $factureNotification->recupAnnee();
        $facturePayer = $this->facturesRepository->findFacturePayerAll();
        $factureNonPayer = $this->facturesRepository->findFactureNonPayerAll();
        $devis = $this->facturesRepository->findDevis();
        $chartCA = $factureNotification->graphCA();
        //Création de la form recherche avec gestion du resultat
        $form = $this->createForm(FacturesRechercheType::class, $rechercheFacture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $resultat = $this->facturesRepository->findSearch($rechercheFacture);
            return $this->render('CRM/projet/factureresultat.html.twig',[
                'resultat' => $resultat
            ]);
        }
        return $this->render('CRM/Projet/factures.html.twig',[
            'totalPayer' => $totalPayer,
            'totalNonPayer' => $totalNonPayer,
            'taux' => $taux,
            'totalN1' => $totalNmoin1,
            'annee' => $anneeCour,
            'facturePayer' => $facturePayer,
            'factureNonPayer' => $factureNonPayer,
            'devis' => $devis,
            'chartCA' => $chartCA,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/index/deletefacture/{id}", name="deletefacture" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @param Factures $factures
     * @param Request $request
     * @return Response
     */

    public function deleteFacture(Factures $factures, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $factures->getId(), $request->get('_token')))
        {
            $id = $factures->getProjet()->getId();
            $this->em->remove($factures);
            $this->em->flush();
            $this->addFlash('success', 'Facture supprimer avec succès');
            return $this->redirectToRoute('factures');

        }
        return $this->redirectToRoute('listeclient');
    }

}