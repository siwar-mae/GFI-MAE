<?php

namespace App\Service\Intervention;

use App\Manager\InterventionManager;

class ReportService
{
    /**
     * @var InterventionManager
     */
    private $manager;

    public function __construct(InterventionManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return mixed
     */
    public function getReportData($id)
    {
        return $this->manager->getReportData($id);
    }
}
