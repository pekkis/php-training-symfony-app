<?php

namespace Huoltoaika\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Huoltoaika\Entity\Car;

class CarService
{
    use FindAllTrait;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('\Huoltoaika\Entity\Car');
    }

    /**
     * @param string $make
     * @param string $model
     * @return Car
     */
    public function createCar(string $make, string $model): Car
    {
        $car = new Car($make, $model);
        $this->em->persist($car);
        $this->em->flush();

        return $car;
    }
}