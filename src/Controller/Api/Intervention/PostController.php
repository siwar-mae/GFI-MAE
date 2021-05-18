<?php


namespace App\Controller\Api\Intervention;


use App\Service\Intervention\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="api_intervention_get_post_form", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function indexAction()
    {
        return $this->render('intervention/add/index.html.twig');
    }

    /**
     * @Route("/api/interventions/post", name="api_intervention_post", options={"expose": true}, methods={"POST", "HEAD"})
     *
     * @return JsonResponse
     */
    public function __invoke(PostService $postService, Request $request)
    {
        $arrayIntervention = json_decode($request->getContent(), true);
        if (null === $arrayIntervention or 'undefined' === $arrayIntervention) {
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'Intervention needs to be defined'], 400);
        }
        if (in_array(null, $arrayIntervention)) {
            $errors = [];

            if ($arrayIntervention['startDate'] === null) {
                array_push($errors, 'start_date_null');
            }
            if ($arrayIntervention['number'] === null) {
                array_push($errors, 'number');
            }
            if ($arrayIntervention['observation'] === null) {
                array_push($errors, 'observation_null');
            }
            if ($arrayIntervention['structure'] === null) {
                array_push($errors, 'structure_null');
            }
            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($postService->post($arrayIntervention)) {
            return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED], Response::HTTP_CREATED);
        }
        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => 'intervention_not_added'], 400);

    }

}