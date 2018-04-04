<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\DiceInterface;

/**
 * A generic Die of arbitrary sides
 **/
class AnyDie implements DiceInterface
{

  /**
   * @var Array - The array of values of each side of this die
   **/
  private $sides;

  /**
   * Constructs a die from the sides given
   * @param Array Should be an Integer array containing the values of the sides of the die
   **/
  function __construct(array $sides){
    if (is_array($sides)){
      $this->sides = $sides;
    }
    /**
     * @todo handle error
     **/
  }

  /**
   * Rolls the die
   * @return Integer  Returns the value of a random side.
   **/
  public function roll(){
    $count = count($this->sides);
    $side = rand(0, ($count - 1));
    return $this->sides[$side];
  }

  /**
   * Returns a String Representation of this die
   * @return String  Example a regular six sided die will be [1,2,3,4,5,6]
   **/
  public function getSides(){
    $str="";
    foreach ($this->sides as $side){
      $str .= (strlen($str) === 0)?$side:", $side";
    }
    return "[$str]";
  }

  /**
   * Returns the number of sides on this die
   * @return Integer
   **/
  public function getSize(){
    return count($this->sides);
  }
}
