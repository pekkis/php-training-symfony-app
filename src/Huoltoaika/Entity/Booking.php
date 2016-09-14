<?php

namespace Huoltoaika\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="booking")
 */
class Booking {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $start;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $end;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="Huoltoaika\Entity\Person", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @var Car
     * @ORM\ManyToOne(targetEntity="Huoltoaika\Entity\Car", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=true)
     */
    private $car;

    /**
     * Booking constructor.
     * @param $start
     * @param $end
     * @param $customer
     * @param $car
     */
    public function __construct(DateTime $start, DateTime $end, Person $customer, Car $car = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->customer = $customer;
        $this->car = $car;
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
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return mixed
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * @param mixed $car
     */
    public function setCar(Car $car)
    {
        $this->car = $car;
    }

}