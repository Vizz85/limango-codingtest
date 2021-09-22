<?php

namespace App\Machine;

class PurchaseTransaction implements PurchaseTransactionInterface {
	private int $itemQuantity;

	private float $paidAmount;

	/**
	 * @param $itemQuantity
	 * @param $paidAmount
	 */
	public function __construct($itemQuantity, $paidAmount) {
		$this->itemQuantity = $itemQuantity;
		$this->paidAmount = $paidAmount;
	}


	public function getItemQuantity(): int {
		return $this->itemQuantity;
	}

	public function getPaidAmount(): float {
		return $this->paidAmount;
	}
}