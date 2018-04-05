<?php

namespace DeliveryDotCom\Models;
use DeliveryDotCom\Contracts\PaymentInterface;

/**
 * A Payment
 **/
class Payment implements PaymentInterface
{
  /**
   * [CASH Payment]
   * @var integer
   */
  const CASH = 1;
  /**
   * [CREDIT_CARD Payment]
   * @var integer
   */
  const CREDIT_CARD = 2;
  /**
   * [REFUND Refund]
   * @var integer
   */
  const REFUND = 3;
  /**
   * [private The amount in this payment]
   * @var [Decimal]
   */
  private $amount;
  /**
   * [private The type of payment - Must be one of the class constants above]
   * @var [Integer]
   */
  private $type;
  /**
   * [public Description attached to this payment. (Optional)]
   * @var [String]
   */
  public $description;

  /**
   * [__construct Class constructor]
   * @param [decimal] $amount [Amount in this payment]
   * @param [integer] $type   [Type of payment - Must be one of the above class constants]
   */
  function __construct($amount, $type){
    //type must be set for amount validation`
    $this->setType($type);
    $this->setAmount($amount);
  }

  /**
   * Sets the type of payment
   * @param [Integer] $type [Type of payment - Must be one of the above class constants]
   * @throws Exception
   */
  public function setType($type){
    if (($type === Payment::CASH) || ($type === Payment::CREDIT_CARD) || ($type === Payment::REFUND)){
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

  /**
   * Sets the amount. If it is a cash or credit card payment then the amount must be greater than zero.
   *                  If it is a refund then the amount must be less than zero.
   * @param [Decimal] $amount [the amount]
   */
  public function setAmount($amount){
    if ( (($this->type === Payment::CASH) || ($this->type === Payment::CREDIT_CARD)) && ($amount > 0) ){
      $this->amount = $amount;
    }
    else if ( ($this->type === Payment::REFUND) && ($amount < 0) ){
      $this->amount = $amount;
    }
    else {
      throw new Exception("Amount is invalid");

    }
  }

}//end class
