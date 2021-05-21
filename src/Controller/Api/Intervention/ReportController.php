<?php

namespace App\Controller\Api\Intervention;

use App\Service\Intervention\ReportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/report/{id}/", name="api_intervention_get_report", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function report(ReportService $reportService, $id)
    {
        $intervention = $reportService->getReportData($id);
        return $this->render('intervention/report/index.html.twig', ['intervention' => $intervention]);
    }
}
