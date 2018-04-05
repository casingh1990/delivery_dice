<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\OrderInterface;
use DeliveryDotCom\Contracts\ItemInterface;
use DeliveryDotCom\Contracts\PaymentInterface;

require_once 'Config.php';

/**
 * An item
 **/
class Order implements OrderInterface
{
  /**
   * @var Array - The Items on this order
   **/
  private $items;
  /**
   * @var Array - The Quantities for each item on this order
   **/
  private $item_quantities;
  /**
   * @var Array - The payments on this order
   **/
  private $payments;
  /**
   * @var Decimal - Sales Tax applied to this order (Expressed as decimal ==> 7% would be stored as 0.07)
   */
  private $sales_tax;
  /**
   * @var Number - The total amount paid on this order
   **/
  private $total_paid;
  /**
   * @var Number - The total amount on this order
   **/
  private $order_total;

  /**
   * Constructor
   * Calls $this->resetOrder() to set the default values for an Order
   **/
  function __construct(){
    $this->resetOrder();
  }

  /**
   * Sets the default values for an order
   **/
  public function resetOrder(){
    $this->items = array();
    $this->item_quantities = array();
    $this->payments = array();
    $total_paid = 0;
    $order_total = 0;
    $this->setSalesTax(CONFIG["sales_tax"]);
  }

  /**
   * This function is used to calculate the total for this order
   * It automatically gives the sales tax as well.
   **/
  public function calculate_order_total(){
    $this->order_total = 0;
    foreach($this->items as $item){
      $this->order_total += $item->getAmount() * $this->item_quantities[$item->getID()];
    }
    $this->order_total += ($this->order_total * $this->sales_tax);
    return $this->order_total;
  }

  /**
   * This function is used to calculate the total amount paid for this order
   **/
  public function calculate_total_paid(){
    $this->total_paid = 0;
    foreach($this->payments as $payment){
      $this->total_paid += $payment->getAmount();
    }
    return $this->total_paid;
  }

  /**
   * Set Sales Tax for this order
   * @param $sales_tax (In Percentage, unless specified as decimal, with $percentage === false)
   * @param $percentage Optional - flag to indicate that the $sales_tax is a percentage (out of 100) or a decimal
   **/
  public function setSalesTax($sales_tax, $percentage = true){
    if ($percentage){
      $this->sales_tax = ($sales_tax / 100);
    }
    else {
      $this->sales_tax = $sales_tax;
    }
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

  /**
   * Gets items and their quantities in this order
   * @return Array - An array containing arrays of ['item'=>{Item Object}, 'quantity' => {Corresponding Quantity}]
   **/
  public function getItems(){
    $order_items = [];
    foreach ($this->items as $item){
      $order_items[] = [
        "item" => $item,
        "quantity" => $this->item_quantities[$item->getID()]
      ];
    }
    return $order_items;
  }
}
