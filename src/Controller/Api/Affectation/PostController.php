<?php


namespace App\Controller\Api\Affectation;


use App\Service\Affectation\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/api/affectations/post", name="api_affectation_post", options={"expose": true}, methods={"POST", "HEAD"})
     *
     * @return JsonResponse
     */
    public function __invoke(PostService $postService, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        dump($data);die;
        if (null === $data or 'undefined' === $data) {
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'Intervention needs to be defined'], 400);
        }
        if (in_array(null, $data)) {
            $errors = [];

            if (null === $data['user']) {
                array_push($errors, 'user_null');
            }
            if (null === $data['date']) {
                array_push($errors, 'date_null');
            }

            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($postService->post($data)) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }

        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'affectation_not_added'], 400);
    }

}