<?php

namespace App\Controller\Subscription;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionController extends AbstractController
{
  public function __construct(
        private Security $security,
    ){
    }

  #[Route(path: '/abonnements', name: 'page_subscription')]
    public function subscription(
      SubscriptionRepository $subscriptionRepository,
      ): Response
    {
      $subscriptions = $subscriptionRepository->findAll();
      return $this->render('subscription/abonnements.html.twig', ['subscriptions' => $subscriptions]);
    }
}