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

  $payment = new Payment(50, Payment::CASH);

  //assuming that logging will be handled by a controller class / middleware

  $order->addItem($fish);
  custom_log("Added item " . $fish->toString() . "\n");
  $order->addItem($chicken);
  custom_log("Added item " . $chicken->toString() . "\n");
  $order->addItem($lettuce);
  custom_log("Added item " . $lettuce->toString() . "\n");

  $order->addPayment($payment);
  custom_log("Added Payment " . $payment->toString() . "\n");

  echo $order->getInvoiceString();
  echo ( ($order->isPaidInFull())?"Order is Paid in full":"Order is not paid in full" ) . "\n";
}catch(Exception $e){
  echo "Error occurred\n" . $e->getMessage() . "\n";
}
