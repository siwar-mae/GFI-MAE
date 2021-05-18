<?php

namespace App\Service\Equipement;

use App\Manager\EquipementManager;

class ListService
{
    /**
     * @var EquipementManager
     */
    private $manager;

    public function __construct(EquipementManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return mixed
     */
    public function getData($code)
    {
        return $this->manager->getData($code);
    }
}
