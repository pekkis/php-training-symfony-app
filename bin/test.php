<?php
declare(strict_types=1);

use Huoltoaika\Entity\Car;

require_once __DIR__ . '/../vendor/autoload.php';

$car = new Car('Honda', 'Civic');

var_dump($car);


