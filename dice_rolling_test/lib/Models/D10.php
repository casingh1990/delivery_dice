<?php

namespace DeliveryDotCom\Models;

/**
 * A 10 sided die
 **/
class D10 extends AnyDie
{
  /**
   * Constructor calls AnyDie's constructor to create a die with defined, default values for 10 sides
   **/
  function __construct(){
    parent::__construct([1,2,3,4,5,6,7,8,9,10]);
  }
}
