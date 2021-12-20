<?php
namespace App\Controller;

use App\Entity\ClientRecherche;
use App\Entity\ContactsRecherche;
use App\Entity\Interlocuteurs;
use App\Entity\Projet;
use App\Entity\Societes;
use App\Form\ClientRechercheType;
use App\Form\ClientType;
use App\Form\ContactsRechercheType;
use App\Form\InterlocuteursType;
use App\Form\ProjetType;
use App\Repository\InterlocuteursRepository;
use App\Repository\SocietesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ClientController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $societesRepository;

    private $interlocuteursRepository;

    public function __construct(EntityManagerInterface $em, SocietesRepository $societesRepository, InterlocuteursRepository $interlocuteursRepository)
    {
        $this->em = $em;
        $this->societesRepository = $societesRepository;
        $this->interlocuteursRepository = $interlocuteursRepository;
    }

    /**
     * @Route("/index/newclient", name="newclient")
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @return Response
     */
    public function newClient(Request $request)
    {
        $client = new Societes();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($client);
            $this->em->flush();
            $this->addFlash('success', 'Nouveau client ajouter');
            return $this->redirectToRoute('listeclient');
        }
        return $this->render('CRM/clients/newclient.html.twig',[
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/index/listeclient", name="listeclient")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function listeClient(Request $request)
    {
        $search = new ClientRecherche();
        $form = $this->createForm(ClientRechercheType::class, $search);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $resultat = $this->societesRepository->findSearch($search);
            $qd = count($resultat);
            return $this->render('CRM/clients/listeclient.html.twig',[
                'listeclients' => $resultat,
                'form' => $form->createView(),
                'qd' => $qd
            ]);
        }
        $listeclient = $this->societesRepository->findSocietes();
        dump($listeclient);
        return $this->render('CRM/clients/listeclient.html.twig',[
            'listeclients' => $listeclient,
            'form' => $form->createView(),
            'qd' => 0
        ]);

    }

    /**
     * @Route("/index/viewclient/{id}", name="viewclient")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     */
    public function viewClient($id)
    {
        $client = $this->societesRepository->find($id);
        return $this->render('CRM/clients/viewclient.html.twig',
            array('client' => $client)
        );

    }

    /**
     * @Route("/index/editclient/{id}", name="editclient" , methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param Societes $societes
     */
    public function editClient(Request $request, Societes $societes)
    {
        $form = $this->createForm(ClientType::class, $societes);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Client modifier avec succès');
            return $this->redirectToRoute('listeclient');
        }
        return $this->render('CRM/clients/editclient.html.twig',[
            'societe' => $societes,
            'form' => $form->createView()
        ]);

    }

    /**
     *  /**
     * @Route("/index/deleteclient/{id}", name="deleteclient" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param Societes $societes
     */

    public function deleteClient(Societes $societes, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $societes->getId(), $request->get('_token')))
        {
            $this->em->remove($societes);
            $this->em->flush();
            $this->addFlash('success', 'Société supprimer avec succès');

        }
        return $this->redirectToRoute('listeclient');
    }

    /**
     * @Route("/index/newinterlocuteur", name="newinterlocuteur")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function newInterlocuteur(Request $request)
    {
        $interlocuteur = new Interlocuteurs();
        $form = $this->createForm(InterlocuteursType::class, $interlocuteur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($interlocuteur);
            $this->em->flush();
            $this->addFlash('success', 'Nouvelle interlocuteur ajouter');
            return $this->redirectToRoute('listeinterlocuteur');
        }
        return $this->render('CRM/clients/newinterlocuteur.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/index/listeinterlocuteur", name="listeinterlocuteur")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function listeInterlocuteur(Request $request)
    {
        $rechercheInterlo = new ContactsRecherche();
        $form = $this->createForm(ContactsRechercheType::class, $rechercheInterlo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $resultat = $this->interlocuteursRepository->findSearch($rechercheInterlo);
            $qd = count($resultat);
            return $this->render('CRM/clients/listeinterlocuteur.html.twig', [
                'listeinterlocuteur' => $resultat,
                'form' => $form->createView(),
                'qd' => $qd
            ]);

        }
        $listeinterlocuteur = $this->interlocuteursRepository->findAll();
        return $this->render('CRM/clients/listeinterlocuteur.html.twig',[
            'listeinterlocuteur' => $listeinterlocuteur,
            'form' => $form->createView(),
            'qd' => 0
        ]);

    }

    /**
     * @Route("/index/editinterlocuteur/{id}", name="editinterlocuteur" , methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param Interlocuteurs $interlocuteurs
     */
    public function editInterlocuteur(Request $request, Interlocuteurs $interlocuteurs)
    {
        $form = $this->createForm(InterlocuteursType::class, $interlocuteurs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Interlocuteur modifier avec succès');
            return $this->redirectToRoute('listeinterlocuteur');
        }
        return $this->render('CRM/clients/editinterlocuteur.html.twig',[
            'societe' => $interlocuteurs,
            'form' => $form->createView()
        ]);

    }

    /**
     *  /**
     * @Route("/index/deleteinterlocuteur/{id}", name="deleteinterlocuteur" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param Interlocuteurs $interlocuteurs
     */

    public function deleteInterlocuteur(Interlocuteurs $interlocuteurs, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $interlocuteurs->getId(), $request->get('_token')))
        {
            $this->em->remove($interlocuteurs);
            $this->em->flush();
            $this->addFlash('success', 'Interlocuteur supprimer avec succès');

        }
        return $this->redirectToRoute('listeinterlocuteur');
    }

    /**
     * @Route("/index/viewcontact/{id}", name="viewcontact")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     */
    public function viewContact($id)
    {
        $contact = $this->interlocuteursRepository->find($id);
        return $this->render('CRM/clients/viewcontact.html.twig',
            array('inter' => $contact)
        );

    }


}