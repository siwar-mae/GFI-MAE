<?php


namespace App\Controller\Api\Equipement;


use App\Service\Equipement\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    /**
     * @Route("/api/equipements/post", name="api_equipement_post", options={"expose": true}, methods={"POST", "HEAD"})
     *
     * @return JsonResponse
     */
        public function __invoke(PostService $postService, Request $request)
    {
        $arrayEquipement = json_decode($request->getContent(), true);
        if (null === $arrayEquipement or 'undefined' === $arrayEquipement) {
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'Equipement needs to be defined'], 400);
        }
        if (in_array(null, $arrayEquipement)) {
            $errors = [];

            if ($arrayEquipement['ref'] === null) {
                array_push($errors, 'ref_null');
            }
            if ($arrayEquipement['price'] === null) {
                array_push($errors, 'price_null');
            }
            if ($arrayEquipement['nature'] === null) {
                array_push($errors, 'nature_null');
            }
            if ($arrayEquipement['designation'] === null) {
                array_push($errors, 'designation_null');
            }
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($postService->post($arrayEquipement)) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }
        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'equipement_not_added'], 400);
    }

}