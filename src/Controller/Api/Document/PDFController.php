<?php


namespace App\Controller\Api\Document;


use App\Service\Intervention\ReportService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PDFController extends AbstractController
{
    /**
     * @Route("/api/documents/pdf/{id}", name="api_document_pdf", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ReportService $reportService, $id)
    {
        $intervention = $reportService->getReportData($id);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('document/pdf/intervention/index.html.twig', [
            'title' => "Welcome to our PDF Test", 'intervention' => $intervention
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
}