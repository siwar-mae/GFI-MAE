<?php


namespace App\Service\Affectation;


use App\Manager\AffectationManager;

class PostService
{
    /**
     * @var AffectationManager
     */
    private $manager;

    public function __construct(AffectationManager $manager)
    {
        $this->manager = $manager;
    }

    public function post($data)
    {
        return $this->manager->post($data);
    }

}