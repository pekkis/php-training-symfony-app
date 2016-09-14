<?php

namespace Huoltoaika\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Huoltoaika\Entity\Booking;
use Huoltoaika\Entity\Car;
use Huoltoaika\Entity\Person;

class BookingService
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
        $this->repository = $em->getRepository('\Huoltoaika\Entity\Booking');
    }

    public function createBooking(\DateTime $start, \DateTime $end, Person $customer, Car $car = null)
    {
        $booking = new Booking(
            $start,
            $end,
            $customer,
            $car
        );

        $this->em->persist($booking);
        $this->em->flush();

        return $booking;
    }
}