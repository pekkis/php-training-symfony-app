<?php

namespace Huoltoaika\Service;

use Doctrine\ORM\EntityManager;
use Huoltoaika\Entity\Person;
use Doctrine\ORM\EntityRepository;
use PhpOption\Option;
use PhpOption\Some;

class PersonService
{
    use FindAllTrait;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('\Huoltoaika\Entity\Person');
    }

    public function createPerson($firstName, $lastName)
    {
        $person = new Person($firstName, $lastName);
        $this->em->persist($person);
        $this->em->flush();
        return $person;
    }

    public function findByName($firstName, $lastName): Option {

        return Option::fromValue($this->repository->findOneBy([
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]));
    }

    public function findOrCreate($firstName, $lastName): Person
    {
        return $this->findByName($firstName, $lastName)->getOrCall(function () use ($firstName, $lastName) {
            return $this->createPerson($firstName, $lastName);
        });
    }
}