<?php

namespace App\Machine;

class PurchaseTransaction implements PurchaseTransactionInterface {
	private int $itemQuantity;

	private float $paidAmount;

	/**
	 * @param $itemQuantity
	 * @param $paidAmount
	 * @throws \Exception
	 */
	public function __construct($itemQuantity, $paidAmount) {
		$this->itemQuantity = $itemQuantity;
		$this->paidAmount = $paidAmount;

		$this->validateTransaction();
	}

	public function getItemQuantity(): int {
		return $this->itemQuantity;
	}

	public function getPaidAmount(): float {
		return $this->paidAmount;
	}

	/**
	 * @throws \Exception
	 */
	private function validateTransaction() {
		if ($this->paidAmount <= 0) {
			throw new \Exception('No money inserted');
		}

		if ($this->paidAmount < $this->itemQuantity * CigaretteMachine::ITEM_PRICE) {
			throw new \Exception('Less money given than total cost of amount');
		}
	}
}