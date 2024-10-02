<?php

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/decouvrir', name: 'page_discover')]
    public function discover(): Response
    {
       return $this->render(view: 'other/discover.html.twig');
    }

    #[Route(path: '/categories', name: 'page_category')]
    public function category(): Response
    {
       return $this->render(view: 'other/category.html.twig');
    }
    
    #[Route(path: '/mes-listes', name: 'page_lists')]
    public function lists(): Response
    {
       return $this->render(view: 'other/lists.html.twig');
    }
}

