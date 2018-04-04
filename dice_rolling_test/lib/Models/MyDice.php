<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\DiceContainerInterface;
use DeliveryDotCom\Contracts\DiceInterface;

class MyDice implements DiceContainerInterface
{
  public $dices;

  function __construct(){
    $this->dices = [];
  }

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
