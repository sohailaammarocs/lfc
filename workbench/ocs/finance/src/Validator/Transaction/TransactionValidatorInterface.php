<?php namespace Ocs\Finance\Validator\Transaction;

interface TransactionValidatorInterface {

	/**
	 * Updating a transaction scenario.
	 *
	 * @return void
	 */
	public function onUpdate();

}
