<?php

namespace App\Controller\Movie;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
   //  #[Route(path: '/decouvrir', name: 'page_discover')]
   //  public function discover(): Response
   //  {
   //     return $this->render(view: 'other/discover.html.twig');
   //  }

   #[Route(path: '/movie/{id}', name: 'page_moviedetail')]
    public function movie(
      string $id,
      MovieRepository $movieRepository,
      ): Response
    {
      $movie = $movieRepository->find($id);
      
      return $this->render('movie/detail.html.twig', ['movie' => $movie]);
    }

    #[Route(path: '/categories', name: 'page_categories')]
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

