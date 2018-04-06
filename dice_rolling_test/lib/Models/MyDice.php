<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\DiceContainerInterface;
use DeliveryDotCom\Contracts\DiceInterface;

/**
 * Dice container
 */
class MyDice implements DiceContainerInterface
{
  /**
   * Array of dice
   * @var Array
   */
  public $dices;

  function __construct(){
    $this->dices = [];
  }

  /**
   * Attach a new die to the Dice container
   * @param  DiceInterface $die the new Die
   */
  public function attach(DiceInterface $die){
    $this->dices[] = $die;
  }

  /**
   * Assuming that getTotal returns the sum of values of each die after each is rolled.
   * @return Integer
   **/
  public function getTotal(){
    $total = 0;
    foreach($this->dices as $dice){
      $total += $dice->roll();
    }
    return $total;
  }
}
