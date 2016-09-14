<?php

declare(strict_types=1);

namespace Huoltoaika\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="car")
 */
class Car {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $make;

    /**
     * @ORM\Column(type="string")
     */
    private $model;

    /**
     * @ORM\OneToMany(targetEntity="Huoltoaika\Entity\Booking", mappedBy="car")
     */
    private $bookings;

    /**
     * Car constructor.
     * @param string $make
     * @param string $model
     */
    public function __construct(string $make, string $model)
    {
        $this->make = $make;
        $this->model = $model;

        $this->bookings = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }
}