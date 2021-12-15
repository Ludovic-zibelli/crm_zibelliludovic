<?php
namespace App\Controller;

use App\Entity\TypeRapport;
use App\Entity\User;
use App\Form\RapportTypeType;
use App\Form\UserType;
use App\Repository\TypeRapportRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class GestionController extends AbstractController
{

    private $em;

    private  $typeRapportRepository;

    private $userRepository;

    public function __construct(EntityManagerInterface $em, TypeRapportRepository $typeRapportRepository, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->typeRapportRepository = $typeRapportRepository;
        $this->userRepository = $userRepository;

    }

    //Gestion des categories
    /**
     * @Route("/index/gestion/newcategory", name="newcategory")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     */
    public function newCategory(Request $request)
    {
        $cat = new TypeRapport();
        $form = $this->createForm(RapportTypeType::class, $cat);
        $form->handleRequest($request);
        $listeCat = $this->typeRapportRepository->findAll();
        if($form->isSubmitted() && $form->isValid())
        {

            $this->em->persist($cat);
            $this->em->flush();
        }
        return $this->render('CRM/gestion/newcategory.html.twig', [
            'form' => $form->createView(),
            'liste' => $listeCat
        ]);
    }

    /**
     *  /**
     * @Route("/index/deletecategorie/{id}", name="deletecategorie" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param TypeRapport $typerapport
     */

    public function deleteClient(TypeRapport $typeRapport, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $typeRapport->getId(), $request->get('_token')))
        {
            $this->em->remove($typeRapport);
            $this->em->flush();
            $this->addFlash('success', 'Categorie supprimer avec succès');

        }
        return $this->redirectToRoute('newcategory');
    }

    //Gestion user

    //Liste des utilisateurs
    /**
     * @Route("/index/listeuser", name="listeuser")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function listeUser()
    {
        $listeuser = $this->userRepository->findAll();
        return $this->render('CRM/gestion/gestionuser.html.twig',[
            'listeuser' => $listeuser
        ]);

    }

    //Nouvelle utilisateur
    /**
     * @Route("/index/newuser", name="newuser")
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passencod
     * @return Response
     */
    public function newUser(Request $request, UserPasswordEncoderInterface $passencod)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $password = $passencod->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Nouvelle utilisateur ajouter');
            return $this->redirectToRoute('listeuser');
        }
        return $this->render('CRM/gestion/newuser.html.twig',[
            'form' => $form->createView()
        ]);
    }

    //Affichage user
    /**
     * @Route("/index/show/{id}", name="show.user")
     * @param Request $request
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        return $this->render('CRM/gestion/viewuser.html.twig',[
            'user' => $user
        ]);
    }

    //Suppression user
    /**
     *  /**
     * @Route("/index/deleteuser/{id}", name="deleteuser" , methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param User $user
     */

    public function deleteUser(User $user, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $user->getId(), $request->get('_token')))
        {
            $this->em->remove($user);
            $this->em->flush();
            $this->addFlash('success', 'Utilisateur supprimer avec succès');

        }
        return $this->redirectToRoute('listeclient');
    }

    //Edition user

    /**
     * @Route("/index/edituser/{id}", name="edituser" , methods="GET|POST")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * @param Request $request
     * @param User $user
     */
    public function editUser(Request $request, User $user)
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $id = $user->getId();
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Utilisateur modifier avec succès');
            return $this->redirectToRoute('listeuser');
        }
        return $this->render('CRM/gestion/edituser.html.twig',[
            'user' => $user,
            'id' => $id,
            'form' => $form->createView()
        ]);

    }
}