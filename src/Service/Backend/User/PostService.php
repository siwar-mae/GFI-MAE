<?php

namespace App\Service\Backend\User;

use App\Manager\Backend\UserManager;

class PostService
{
    /**
     * @var UserManager
     */
    private $manager;

    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    public function post($arrayUser)
    {
        return $this->manager->post($arrayUser);
    }
}
