<?php
require __DIR__ . '/vendor/autoload.php';

use DeliveryDotCom\Models\Item;
use DeliveryDotCom\Models\Order;
use DeliveryDotCom\Models\Payment;

require_once '../common/helper.php';

try{
  $order = new Order();

  $fish = new Item("fish", 14);
  $chicken = new Item("chicken", 10);
  $lettuce = new Item("lettuce", 4);

  $order->addItem($fish);
  $order->addItem($chicken);
  $order->addItem($lettuce);

  $order->addPayment(new Payment(50, Payment::CASH));

  echo $order->getInvoiceString();
  echo ( ($order->isPaidInFull())?"Order is Paid in full":"Order is not paid in full" ) . "\n";
}catch(Exception $e){
  echo "Error occurred\n" . $e->getMessage() . "\n";
}
