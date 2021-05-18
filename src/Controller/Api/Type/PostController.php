<?php


namespace App\Controller\Api\Type;


use App\Service\Type\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    /**
     * @Route("/api/types/post", name="api_type_post", options={"expose": true}, methods={"POST", "HEAD"})
     *
     * @return JsonResponse
     */
    public function __invoke(PostService $postService, Request $request)
    {
        $param = json_decode($request->getContent(), true);
        $desc = $param['type'];
        if (null === $desc or 'undefined' === $desc or $desc === "") {
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'Type needs to be defined'], 400);
        }
        if ($postService->post($desc)) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }
        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'type_not_added'], 400);
    }

}