<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPassType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function login(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager)
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $lastUsername]);

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'user' => $user]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/forget-pass", name="app_forgotten_password")
     */
    public function forgetPass(Request $request,
                              \Swift_Mailer $mailer,
                              TokenGeneratorInterface $tokenGenerator,
                              EntityManagerInterface $entityManager): Response
    {
        $locale = $request->getLocale();
        // On initialise le formulaire
        $form = $this->createForm(ResetPassType::class, array('locale' => $locale));

        // On traite le formulaire
        $form->handleRequest($request);

        // Si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On r??cup??re les donn??es
            $donnees = $form->getData();

            // On cherche un utilisateur ayant cet e-mail
            $user = $entityManager->getRepository(User::class)->findOneByEmail($donnees['email']);
            // Si l'utilisateur n'existe pas
            if ($user === null) {
                // On envoie une alerte disant que l'adresse e-mail est inconnue
                $this->addFlash('danger', 'Cette adresse e-mail est inconnue');

                // On retourne sur la page de connexion
                return $this->redirectToRoute('app_login');
            }

            // On g??n??re un token
            $token = $tokenGenerator->generateToken();

            // On essaie d'??crire le token en base de donn??es
            try{
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_login');
            }

            // On g??n??re l'URL de r??initialisation de mot de passe
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            // On g??n??re l'e-mail
            $message = (new \Swift_Message('Mot de passe oubli??'))
                ->setFrom('siwbouss@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Bonjour,<br><br>Une demande de r??initialisation de mot de passe a ??t?? effectu??e pour le site Nouvelle-Techno.fr. Veuillez cliquer sur le lien suivant : " . $url,
                    'text/html'
                )
            ;
            // On envoie l'e-mail
            $mailer->send($message);

            // On cr??e le message flash de confirmation
            $this->addFlash('message', 'E-mail de r??initialisation du mot de passe envoy?? !');
            // On redirige vers la page de login
            return $this->redirectToRoute('app_reset_password', ['token' => $token]);
        }
        // On envoie le formulaire ?? la vue
        return $this->render('security/forgotten_password.html.twig',['emailForm' => $form->createView()]);
    }

    /**
     * @Route("/reset-pass-{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        // On cherche un utilisateur avec le token donn??
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('app_login');
        }

        // Si le formulaire est envoy?? en m??thode post
        if ($request->isMethod('POST')) {
            // On supprime le token
            $user->setResetToken(null);

            // On chiffre le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

            // On stocke
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // On cr??e le message flash

            $this->addFlash('message', 'Mot de passe mis ?? jour');
            // On redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        }else {
            // Si on n'a pas re??u les donn??es, on affiche le formulaire
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}
