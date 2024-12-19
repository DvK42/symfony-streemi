<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
  public function __construct(
    private UserRepository $userRepository,
  ) {
  }

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
  public function forgot(
    Request $request,
    EntityManagerInterface $entityManager,
    MailerInterface $mailer,
  ) {
    $email = $request->get('email');

    if ($email) {
      $user = $this->userRepository->findOneBy(['email' => $email]);
      if ($user) {
        $resetPasswordToken = Uuid::v4();
        $user->setResetPasswordToken($resetPasswordToken);
        $entityManager->flush();

        $template = (new TemplatedEmail())
          ->to(addresses: $email)
          ->from(addresses: 'team@streami.fr')
          ->subject(subject: 'Réinitialisation de mot de passe')
          ->htmlTemplate(template: 'email/forgot.html.twig')
          ->context(context: [
            'token' => $resetPasswordToken,
            'username' => $user->getUsername(),
          ]);

        $mailer->send($template);
        $this->addFlash(type: 'success', message: 'Email envoyé');
      } else {
        $this->addFlash(type: 'error', message: 'Aucun utilisateur trouvé');
      }

      return $this->render(view: 'auth/forgot.html.twig');
    }
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
