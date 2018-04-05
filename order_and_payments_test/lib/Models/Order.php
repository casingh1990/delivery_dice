<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\OrderInterface;
use DeliveryDotCom\Contracts\ItemInterface;
use DeliveryDotCom\Contracts\PaymentInterface;

/**
 * An item
 **/
class Order implements OrderInterface
{
  private $items;
  private $item_quantities;
  private $payments;
  private $total_paid;
  private $order_total;

  function __construct(){
    $this->resetOrder();
  }

  public function resetOrder(){
    $this->items = array();
    $this->item_quantities = array();
    $this->payments = array();
    $total_paid = 0;
    $order_total = 0;
  }

  public function calculate_order_total(){
    $this->order_total = 0;
    foreach($this->items as $item){
      $this->order_total += $item->getAmount() * $this->item_quantities[$item->getID()];
    }
    return $this->order_total;
  }

  public function calculate_total_paid(){
    $this->total_paid = 0;
    foreach($this->payments as $payment){
      $this->total_paid += $payment->getAmount();
    }
    return $this->total_paid;
  }

  /**
  * @param ItemInterface $item An item that is part of the order
  */
  public function addItem(ItemInterface $item){
    //check for duplicate item
    if (array_key_exists($item->getID(), $this->item_quantities)){
      $this->item_quantities[$item->getID()]++;
    }
    else{
      $this->items[] = $item;
      $this->item_quantities[$item->getID()] = 1;
    }
    //recalculate order total;
    $this->order_total += $item->getAmount() * $this->item_quantities[$item->getID()];
  }

  /**
  * @param PaymentInterface $payment A payment that has been applied to the order
  */
  public function addPayment(PaymentInterface $payment){
    $this->total_paid += $payment->getAmount();
    $this->payments[] = $payment;
  }

  /**
  * @return bool true if the order has been paid in full, false if not.
  */
  public function isPaidInFull(){
    return ($this->calculate_total_paid() >= $this->calculate_order_total());
  }
}
