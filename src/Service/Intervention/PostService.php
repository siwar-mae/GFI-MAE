<?php


namespace App\Service\Intervention;


use App\Manager\InterventionManager;

class PostService
{
    /**
     * @var InterventionManager
     */
    private $manager;

    public function __construct(InterventionManager $manager)
    {
        $this->manager = $manager;
    }

    public function post($arrayIntervention)
    {
        return $this->manager->post($arrayIntervention);

    }
}