<?php

namespace App\Command;

use App\Machine\CigaretteMachine;
use App\Machine\PurchaseTransaction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
		try {
	        $itemCount = (int) $input->getArgument('packs');
	        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

			$purchaseTransaction = new PurchaseTransaction($itemCount, $amount);

			$cigaretteMachine = new CigaretteMachine();
		    $purchasedItem = $cigaretteMachine->execute($purchaseTransaction);

			$purchasedItemQuantity = $purchasedItem->getItemQuantity();

			if ($purchasedItemQuantity > 0) {
				$output->writeln('You bought <info>'.$purchasedItemQuantity.'</info> packs of cigarettes for <info>-'.$purchasedItem->getTotalAmount().'€</info>, each for <info>-'.CigaretteMachine::ITEM_PRICE.'€</info>.');
			} else {
				$output->writeln('You bought no cigarettes.');
			}

	        $output->writeln('Your change is:');

	        $table = new Table($output);
	        $table
	            ->setHeaders(array('Coins', 'Count'))
	            ->setRows($purchasedItem->getChange())
	        ;
	        $table->render();
		} catch(\Exception $e) {
			$output->writeln($e->getMessage());
		}
    }
}