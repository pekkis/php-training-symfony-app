<?php

namespace AppBundle\Controller;

use Huoltoaika\Service\CarService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var CarService $carService */
        $carService = $this->get('services.car');
        $cars = $carService->findAll();
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'cars' => $cars,
        ]);
    }
}
