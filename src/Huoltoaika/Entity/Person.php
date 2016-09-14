<?php

namespace Huoltoaika\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="Huoltoaika\Entity\Booking", mappedBy="person")
     */
    private $bookings;

    /**
     * Person constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}