<?php

namespace App\Service\Affectation;

use App\Manager\AffectationManager;

class ListService
{
    /**
     * @var AffectationManager
     */
    private $manager;

    public function __construct(AffectationManager $manager)
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
