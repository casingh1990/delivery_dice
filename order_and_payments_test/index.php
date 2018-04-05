<?php
require __DIR__ . '/vendor/autoload.php';

use DeliveryDotCom\Models\Item;
use DeliveryDotCom\Models\Order;
use DeliveryDotCom\Models\Payment;


$order = new Order();

$fish = new Item("fish", 10);
$chicken = new Item("chicken", 10);
$lettuce = new Item("lettuce", 4);

$order->addItem($fish);
$order->addItem($chicken);
$order->addItem($lettuce);

$order->addPayment(new Payment(50, Payment::CASH));

echo "Order total is " . $order->calculate_order_total() . "\n";
echo "Total Paid is " . $order->calculate_total_paid() . "\n";
echo ( ($order->isPaidInFull())?"Order is Paid in full":"Order is not paid in full" ) . "\n";
