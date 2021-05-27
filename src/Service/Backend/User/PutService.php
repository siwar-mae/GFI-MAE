<?php


namespace App\Service\Backend\User;


use App\Manager\Backend\UserManager;

class PutService
{
    /**
     * @var UserManager
     */
    private $manager;

    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    public function put($arrayUser)
    {
        return $this->manager->put($arrayUser);
    }
}