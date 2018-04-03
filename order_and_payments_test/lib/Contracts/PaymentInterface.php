<?php

namespace DeliveryDotCom\Contracts;

interface OrderInterface
{
	/**
	* @param ItemInterface $item An item that is part of the order
	*/
	public function addItem(ItemInterface $item);

	/**
	* @param PaymentInterface $payment A payment that has been applied to the order
	*/
	public function addPayment(PaymentInterface $payment);

	/**
	* @return bool true if the order has been paid in full, false if not.
	*/
	public function isPaidInFull();
}
