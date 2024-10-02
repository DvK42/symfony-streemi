<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin', name: 'page_admin')]
    public function admin(): Response
    {
       return $this->render(view: 'admin/admin.html.twig');
    }

    #[Route(path: '/admin/films', name: 'page_admin_films')]
    public function films(): Response
    {
       return $this->render(view: 'admin/admin_films.html.twig');
    }

    #[Route(path: '/admin/add-films', name: 'page_admin_add_films')]
    public function add_films(): Response
    {
       return $this->render(view: 'admin/admin_add_films.html.twig');
    }

    #[Route(path: '/admin/users', name: 'page_admin_users')]
    public function users(): Response
    {
       return $this->render(view: 'admin/admin_users.html.twig');
    }
       
}