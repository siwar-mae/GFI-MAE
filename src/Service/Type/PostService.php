<?php


namespace App\Service\Type;


use App\Manager\TypeManager;

class PostService
{
    /**
     * @var TypeManager
     */
    private $manager;

    public function __construct(TypeManager $manager)
    {
        $this->manager = $manager;
    }

    public function post($description)
    {
        return $this->manager->post($description);

    }
}