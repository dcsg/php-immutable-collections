<?php

$loader = require __DIR__ . '/../../vendor/autoload.php';
$loader->addPsr4('Examples\\DCSG\\ImmutableCollections\\CargoLegs\\', __DIR__);

use Examples\DCSG\ImmutableCollections\CargoLegs\Leg;
use Examples\DCSG\ImmutableCollections\CargoLegs\Legs;

$legs = Legs::create([
    new Leg('Lisbon', 'Porto', 240),
    new Leg('Lisbon', 'Aveiro', 200),
    new Leg('Lisbon', 'Setubal', 40),
    new Leg('Porto', 'Setubal', 280),
    new Leg('Porto', 'Lisbon', 240),
]);

$totalDistance = $legs->totalDistance();

echo "Total distance: {$totalDistance}km\n";
echo "# Legs from Lisbon: {$legs->from('Lisbon')->count()}\n";
echo "# Legs to Setubal: {$legs->to('Setubal')->count()}\n";
echo "# Legs from Porto: {$legs->from('Porto')->count()}\n";
echo "# Legs to Porto: {$legs->to('Porto')->count()}\n";

echo "\n## Log\n";
$legs->printLog();
