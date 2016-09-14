<?php

namespace Huoltoaika\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="person",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="name_idx", columns={"first_name", "last_name"})}
 * )
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
     * @ORM\OneToMany(targetEntity="Huoltoaika\Entity\Booking", mappedBy="customer")
     */
    private $bookings;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $creditRating;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * Person constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(
        string $firstName,
        string $lastName,
        \DateTime $birthDate,
        string $creditRating,
        string $city
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->creditRating = $creditRating;
        $this->city = $city;

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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    /**
     * @return string
     */
    public function getCreditRating(): string
    {
        return $this->creditRating;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

}