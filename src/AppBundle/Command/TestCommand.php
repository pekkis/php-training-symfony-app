<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Huoltoaika\Entity\Booking;
use Huoltoaika\Entity\Car;
use Huoltoaika\Entity\Person;
use Huoltoaika\Service\BookingService;
use Huoltoaika\Service\CarService;
use Huoltoaika\Service\PersonService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Debug\Debug;
use DateTime;
use Xi\Collections\Collection\ArrayCollection;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('test')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        /** @var BookingService $bookingService */
        $bookingService = $this->getContainer()->get('services.booking');

        /** @var CarService $carService */
        $carService = $this->getContainer()->get('services.car');

        /** @var PersonService $personService */
        $personService = $this->getContainer()->get('services.person');

        $persons = $personService->findAll();
        $persons = array_slice($persons, 0, 1000);

        $endDate = new DateTime('1971-01-01 00:00:00');

        ArrayCollection::create($persons)
            ->filter(function (Person $person) use ($endDate) {
                return $person->getCity() === 'Laihia' &&
                $person->getBirthDate() < $endDate &&
                $person->getCreditRating() == 'A++';
            })
            ->sortWith(function (Person $a, Person $b) {
                return strcmp($a->getLastName(), $b->getLastName());
            })
            ->map(function (Person $person) {
                return sprintf("%s %s => %s", $person->getFirstName(), $person->getLastName(), $person->getCreditRating());
            })
            ->each(function (string $person) use ($output) {
                $output->writeln($person);
            });

        /*
        $goodPersons = [];
        foreach ($persons as $person) {
            if ($person->getCity() === 'Laihia' &&
                $person->getBirthDate() < $endDate &&
                $person->getCreditRating() == 'A++'
            ) {
                $goodPersons[] = $person;
            }
        }

        foreach ($goodPersons as $person) {
            $output->writeln(
                sprintf("%s %s => %s", $person->getFirstName(), $person->getLastName(), $person->getCreditRating())
            );
        }
        */



    }

}
