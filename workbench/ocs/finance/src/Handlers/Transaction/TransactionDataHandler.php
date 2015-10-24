<?php namespace Ocs\Finance\Handlers\Transaction;

class TransactionDataHandler implements TransactionDataHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function prepare(array $data)
	{
		return $data;
	}

}
