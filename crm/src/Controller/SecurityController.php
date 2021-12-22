<?php

namespace App\Controller;

use App\Notifications\factureNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{

    /**
     * @Route("/", name="login")
     * @param AuthenticationUtils $AuthenticationUtils
     * @param factureNotification $factureNotification
     * @return Response
     */
    public function login(AuthenticationUtils $AuthenticationUtils, factureNotification $factureNotification )
    {
        $error = $AuthenticationUtils->getLastAuthenticationError();
        $lastUsername = $AuthenticationUtils->getLastUsername();
        $annee = $factureNotification->recupAnnee();
        return $this->render('CRM/login.html.twig', [
            'last_user' => $lastUsername,
            'error' => $error,
            'annee' => $annee
        ]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}

