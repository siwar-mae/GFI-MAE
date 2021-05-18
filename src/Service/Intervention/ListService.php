<?php

namespace App\Service\Intervention;

use App\Manager\InterventionManager;

class ListService
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
    public function getData()
    {
        return $this->manager->getData();
    }
}
