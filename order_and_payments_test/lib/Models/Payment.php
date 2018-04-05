<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\PaymentInterface;

/**
 * A Payment
 **/
class Payment implements PaymentInterface
{
  const CASH = 1;
  const CREDIT_CARD = 2;
  private $amount;
  private $type;
  public $description;

  function __construct($amount, $type){
    $this->amount = $amount;
    $this->setType($type);
  }

  public function setType($type){
    if (($type === Payment::CASH) || ($type === Payment::CREDIT_CARD)){
      $this->type = $type;
    }
    else{
      throw new Exception("Type is invalid");
    }
  }
  /**
	* @return int The amount of the individual payment
	*/
	public function getAmount(){
    return $this->amount;
  }
}
