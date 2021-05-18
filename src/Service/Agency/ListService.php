<?php

namespace App\Service\Agency;

use App\Manager\AgencyManager;

class ListService
{
    /**
     * @var AgencyManager
     */
    private $manager;

    public function __construct(AgencyManager $manager)
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
