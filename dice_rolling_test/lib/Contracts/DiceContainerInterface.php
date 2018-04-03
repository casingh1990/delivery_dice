<?php

namespace DeliveryDotCom\Contracts;

interface DiceContainerInterface
{
	public function attach(DiceInterface $die);
	public function getTotal();
}
