<?php

namespace DeliveryDotCom\Models;

class D4 extends AnyDie
{
  /**
   * Constructor calls AnyDie's constructor to create a die with defined, default values for 10 sides
   **/
  function __construct(){
    parent::__construct([1,2,3,4]);
  }
}
