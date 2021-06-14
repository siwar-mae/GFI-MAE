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
        if ($postService->post($data) === true) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }else if(in_array('user_not_found', $postService->post($data))){
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'user_not_found'], 400);
        }else{
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'affectation_not_added'], 400);
        }
    }
}