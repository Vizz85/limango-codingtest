<?php

namespace App\Machine;

class PurchasedItem implements PurchasedItemInterface {
	private int $itemQuantity;

	private float $totalAmount;

	private array $change;

	/**
	 * @param int   $itemQuantity
	 * @param float $totalAmount
	 * @param array $change
	 */
	public function __construct(int $itemQuantity, float $totalAmount, array $change) {
		$this->itemQuantity = $itemQuantity;
		$this->totalAmount = $totalAmount;
		$this->change = $change;
	}

	public function getItemQuantity() {
		return $this->itemQuantity;
	}

	public function getTotalAmount() {
		return $this->totalAmount;
	}

	public function getChange() {
		return $this->change;
	}
}