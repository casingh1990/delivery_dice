<?php

namespace DeliveryDotCom\Contracts;

interface PaymentInterface
{
	/**
	* @return int The amount of the individual payment
	*/
	public function getAmount();
}
