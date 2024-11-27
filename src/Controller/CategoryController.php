<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'page_category')]
    public function category(
        string $id,
        CategorieRepository $categoryRepository,
    ): Response
    {
        $category = $categoryRepository->find($id);

        return $this->render('movie/category.html.twig', ['category' => $category]);
    }

    #[Route('/decouvrir', name: 'page_discover')]
    public function discover(
        EntityManagerInterface $entityManager,
        CategorieRepository $categoryRepository,
    ): Response
    {

        $categories = $categoryRepository->findAll();

        return $this->render('movie/discover.html.twig', [
            'categories' =>  $categories,
        ]);
    }
}
