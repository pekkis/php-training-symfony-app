<?php

namespace Huoltoaika\Service;

use Doctrine\ORM\EntityManager;

class CarService
{
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository('\Huoltoaika\Entity\Car');
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

}