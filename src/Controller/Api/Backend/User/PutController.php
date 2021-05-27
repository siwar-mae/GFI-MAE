<?php


namespace App\Controller\Api\Backend\User;

use App\Entity\User;
use App\Service\Backend\User\PutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PutController extends AbstractController
{
    /**
     * @Route("putUser/{id}", name="api_user_get_put_form", options={"expose": true}, methods={"GET", "HEAD"})
     * @ParamConverter("user", options={"id" = "id"})
     */
    public function indexAction(Security $security, User $user)
    {
        return $this->render('backend/user/edit/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/api/users/put", name="api_user_put")
     * @return JsonResponse
     */
    public function __invoke(PutService $putService, Request $request)
    {
        $arrayUser = json_decode($request->getContent(), true);
        if (null === $arrayUser or 'undefined' === $arrayUser) {
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'User needs to be defined'], 400);
        }
        if ($putService->put($arrayUser)) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }

        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'user_not_updated'], 400);
    }
}