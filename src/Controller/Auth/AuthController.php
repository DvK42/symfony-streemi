<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route(path: '/login', name: 'page_login')]
    public function login()
    {
       return $this->render(view: 'auth/login.html.twig');
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
}