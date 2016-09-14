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

        $car = $carService->createCar('Honda', 'Civic');
        $person = $personService->createPerson('Gaylord', 'Lohiposki');

        $booking = $bookingService->createBooking(
            new \DateTime('2015-09-10 08:00:00'),
            new \DateTime('2015-09-10 12:00:00'),
            $person,
            $car
        );

        \Doctrine\Common\Util\Debug::dump($booking);
        die();


        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }

        $output->writeln('Command result.');
    }

}
