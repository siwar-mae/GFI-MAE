<?php

namespace App\Controller\Api\Backend\User;

use App\Service\Backend\User\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("postUser", name="api_user_get_post_form", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function indexAction()
    {
        return $this->render('backend/user/add/index.html.twig');
    }

    /**
     * @Route("/api/users/post", name="api_user_post", options={"expose": true}, methods={"POST", "HEAD"})
     *
     * @return JsonResponse
     */
    public function __invoke(PostService $postService, Request $request)
    {
        $arrayUser = json_decode($request->getContent(), true);
        if (null === $arrayUser or 'undefined' === $arrayUser) {
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'User needs to be defined'], 400);
        }

        if (in_array("", $arrayUser)) {
            $errors = [];
            if ("" === $arrayUser['email']) {
                array_push($errors, 'email_null');
            }
            if ("" === $arrayUser['fullName']) {
                array_push($errors, 'fullName_null');
            }
            if ("" === $arrayUser['roles']) {
                array_push($errors, 'roles_null');
            }
            if ("" === $arrayUser['address']) {
                array_push($errors, 'address_null');
            }
            if ("" === $arrayUser['thumb']) {
                array_push($errors, 'thumb_null');
            }
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($postService->post($arrayUser)) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }

        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'user_not_added'], 400);
    }
}
