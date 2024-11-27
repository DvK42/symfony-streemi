<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    #[Route(path: '/login', name: 'page_login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
      $error = $authenticationUtils->getLastAuthenticationError();

      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('auth/login.html.twig', [
         'last_username' => $lastUsername,
         'error' => $error,
      ]);
    }

    #[Route(path: '/register', name: 'page_register')]
    public function register()
    {
       return $this->render(view: 'auth/register.html.twig');
    }

    #[Route(path: '/forgot', name: 'page_forgot')]
    public function forgot()
    {
       return $this->render(view: 'auth/forgot.html.twig');
    }

    #[Route(path: '/confirm', name: 'page_confirm')]
    public function confirm()
    {
       return $this->render(view: 'auth/confirm.html.twig');
    }

    #[Route(path: '/reset', name: 'page_reset')]
    public function reset()
    {
       return $this->render(view: 'auth/reset.html.twig');
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}