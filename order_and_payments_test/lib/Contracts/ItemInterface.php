<?php

namespace DeliveryDotCom\Contracts;

interface ItemInterface
{
	/**
	* @return int The price of the individual item
	*/
	public function getAmount();
}
