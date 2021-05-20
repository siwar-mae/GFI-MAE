<?php

namespace App\Service\Backend\User;

use App\Manager\Backend\UserManager;

class ListService
{
    /**
     * @var UserManager
     */
    private $manager;

    public function __construct(UserManager $manager)
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
