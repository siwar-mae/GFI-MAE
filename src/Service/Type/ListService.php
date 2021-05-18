<?php

namespace App\Service\Type;

use App\Manager\TypeManager;

class ListService
{
    /**
     * @var TypeManager
     */
    private $manager;

    public function __construct(TypeManager $manager)
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
