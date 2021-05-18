<?php


namespace App\Service\Equipement;


use App\Manager\EquipementManager;

class PostService
{
    /**
     * @var EquipementManager
     */
    private $manager;

    public function __construct(EquipementManager $manager)
    {
        $this->manager = $manager;
    }

    public function post($arrayEquipement)
    {
        return $this->manager->post($arrayEquipement);

    }
}