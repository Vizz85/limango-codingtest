<?php

namespace App\Machine;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface {
    const ITEM_PRICE = 4.99;

	public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItem {
		$paidAmount = $purchaseTransaction->getPaidAmount();
		$itemQuantity = $purchaseTransaction->getItemQuantity();
		$totalAmount = $itemQuantity * self::ITEM_PRICE;
		$change = $this->calculateChange($paidAmount, $totalAmount);

		return new PurchasedItem($itemQuantity, $totalAmount, $change);
	}

	private function calculateChange($paidAmount, $totalAmount) {
		$change = array();

		$coins = array(
			2, 1, 0.5, 0.2, 0.1, 0.05, 0.02, 0.01
		);

		$rest = $paidAmount - $totalAmount;

		foreach($coins as $coin) {
			if ($rest === 0.0) {
				break;
			}

			$coinCount = 0;

			while(bccomp($rest, $coin, 2) >= 0) {
				$coinCount++;
				$rest -= $coin;
				$rest = round($rest, 2);
			}

			if ($coinCount > 0) {
				$change[] = [$coin, $coinCount];
			}
		}

		return $change;
	}
}