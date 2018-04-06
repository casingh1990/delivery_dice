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

  /**
   * Constructor
   * @param String $name   Name for this item
   * @param Number $amount Price of this item
   */
  function __construct($name, $amount){
    $this->id = Item::$nextID++;
    $this->setAmount($amount);
    $this->setName($name);
  }

  /**
   * Get ID for this item
   * @return Integer The ID
   */
  public function getID(){
    return $this->id;
  }

  /**
   * Sets the name for this item
   * @param String $name The new name
   * @throws Exception
   */
  public function setName($name){
    if (is_string($name)){
      $this->name = $name;
    }
    else{
      throw new Exception("Name must be a string");
    }
  }

  /**
   * Gets the name for this item
   * @return String The name of this item.
   */
  public function getName(){
    return $this->name;
  }

  /**
   * Sets the price for this item
   * @param Number The price for this item
   */
  public function setAmount($amount){
    if (is_numeric($amount)){
      $this->amount = $amount;
    }
    else{
      throw new Exception("Amount is not a number");
    }
  }

  /**
   * Returns the price of this item
   * @return Number the price of this item
   */
  public function getAmount(){
    return $this->amount;
  }

  /**
   * Returns a String Representation of this Item
   * @var String
   */
  public function toString(){
    return $this->getName() . " " . $this->getAmount();
  }

}
