<?php


namespace App\Controller;

use App\Form\ResettingType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Security\Mailer;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * @Route("/password-renewal")
 */
class ResettingController extends AbstractController
{
    /**
     * @Route("/requete", name="request_resetting")
     */
    public function request(Request $request, Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        // création d'un formulaire "à la volée", afin que l'internaute puisse renseigner son mail
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank()
                ]
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            // voir l'épisode 2 de cette série pour retrouver la méthode loadUserByUsername:
            $user = $em->getRepository(User::class)->findOneBy($form->getData()['email']);

            // aucun email associé à ce compte.
            if (!$user) {
                $request->getSession()->getFlashBag()->add('warning', "Cet email n'existe pas.");
                return $this->redirectToRoute("request_resetting");
            }

            // création du token
            $user->setToken($tokenGenerator->generateToken());
            // enregistrement de la date de création du token
            $user->setPasswordRequestedAt(new \Datetime());
            $em->flush();

            // on utilise le service Mailer créé précédemment
            $bodyMail = $mailer->createBodyMail('resetting/mail.html.twig', [
                'user' => $user
            ]);
            $mailer->sendMessage('from@email.com', $user->getEmail(), 'renouvellement du mot de passe', $bodyMail);
            $request->getSession()->getFlashBag()->add('success', "Un mail va vous être envoyé afin que vous puissiez renouveller votre mot de passe. Le lien que vous recevrez sera valide 24h.");

            return $this->redirectToRoute("test");
        }

        return $this->render('resetting/request.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // si supérieur à 10min, retourne false
    // sinon retourne false
    private function isRequestInTime(\Datetime $passwordRequestedAt = null)
    {
        if ($passwordRequestedAt === null)
        {
            return false;
        }

        $now = new \DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $daySeconds = 60 * 10;
        $response = $interval > $daySeconds ? false : $reponse = true;
        return $response;
    }

    /**
     * @Route("/reset/{id}/{token}", name="resetting", requirements={"token"=".+"})
     */
    public function resetting(User $user, $token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user->setToken($token);
        $date = new \DateTime();
        $date->format('Y-m-d H:i:s');
        $user->setPasswordRequestedAt($date);
        if ($user->getToken() === null || $token !== $user->getToken() || !$this->isRequestInTime($user->getPasswordRequestedAt()))
        {
            throw new AccessDeniedHttpException();
        }
        $form = $this->createForm(ResettingType::class, $user);
        $form->handleRequest($request);
        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);

        // réinitialisation du token à null pour qu'il ne soit plus réutilisable
        $user->setToken(null);
        $user->setPasswordRequestedAt(null);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success', "Votre mot de passe a été renouvelé.");
        return $this->redirectToRoute('app_login');
    }
}