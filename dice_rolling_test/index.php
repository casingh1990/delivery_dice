<?php

use DeliveryDotCom\Models\MyDice;
use DeliveryDotCom\Models\D10;
use DeliveryDotCom\Models\D8;
use DeliveryDotCom\Models\D6;
use DeliveryDotCom\Models\D4;
use DeliveryDotCom\Models\AnyDie;

// You may modify this file as necessary to handle your dependencies

// Implement all of the classes that allow you to write the following code:

$container = new MyDice();
$container->attach(new D10()); // 10-sided die
$container->attach(new D8()); // 8-sided die
$container->attach(new D6()); // 6-sided die
$container->attach(new D4()); // 4-sided die
$container->attach(new AnyDie([0, 0, 1, 2, 3, 3])); // A die with arbitrary faces
$total = $container->getTotal();

echo "Total of all dice: $total\n";

