<?php

namespace DeliveryDotCom\Models;
use \Exception;
use DeliveryDotCom\Contracts\ItemInterface;

/**
 * An item
 **/
class Item implements ItemInterface
{
  /**
   * @var int The amount of this item.
   **/
  private $amount;
  /**
   * @var string The name of this Item
   **/
  private $name;
  /**
   * @var string this description of this Item
   **/
  private $description;
  /**
   * @var int the ID of this item
   **/
  private $id;
  /**
   * @var int the next ID for a newly created instance. Ideally in a database driven environment this will be the auto_increment for the table that this class represents
   **/
  private static $nextID=1;

  function __construct($name, $amount){
    $this->id = Item::$nextID++;
    $this->setAmount($amount);
    $this->setName($name);
  }

  public function getID(){
    return $this->id;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function getName(){
    return $this->name;
  }

  public function setAmount($amount){
    if (is_numeric($amount)){
      $this->amount = $amount;
    }
    else{
      throw new Exception("Amount is not a number");
    }
  }

  public function getAmount(){
    return $this->amount;
  }
}
