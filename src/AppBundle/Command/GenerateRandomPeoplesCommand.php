<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Huoltoaika\Entity\Person;
use Huoltoaika\Service\PersonService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use DateTime;
use Knapsack\Collection;

function randStrGen($len){
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXYZ";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
        $randItem = array_rand($charArray);
        $result .= "".$charArray[$randItem];
    }
    return $result;
}



class GenerateRandomPeoplesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('generate-random-peoples')
            ->setDescription('Generates random peoples')
            ->addArgument('count', InputArgument::REQUIRED, 'How many peoples')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $input->getArgument('count');

        $cities = [
            'Turku',
            'Helsinki',
            'Tampere',
            'Laihia',
            'Vantaa',
            'Espoo',
        ];

        $creditRatings = [
            'A++',
            'A+',
            'A',
            'B',
            'C',
            'D',
            'F'
        ];

        /** @var PersonService $personService */
        $personService = $this->getContainer()->get('services.person');

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        Collection::range(1, $count)->each(function () use ($em, $creditRatings, $cities) {

            $person = new Person(
                randStrGen(10),
                randStrGen(40),
                DateTime::createFromFormat('U', rand(10, 100000000)),
                $creditRatings[array_rand($creditRatings)],
                $cities[array_rand($cities)]
            );

            $em->persist($person);
        });

        $em->flush();

    }

}
