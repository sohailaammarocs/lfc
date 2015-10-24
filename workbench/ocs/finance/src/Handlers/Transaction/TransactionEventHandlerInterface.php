<?php namespace Ocs\Finance\Handlers\Transaction;

use Ocs\Finance\Models\Transaction;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface TransactionEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a transaction is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a transaction is created.
	 *
	 * @param  \Ocs\Finance\Models\Transaction  $transaction
	 * @return mixed
	 */
	public function created(Transaction $transaction);

	/**
	 * When a transaction is being updated.
	 *
	 * @param  \Ocs\Finance\Models\Transaction  $transaction
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Transaction $transaction, array $data);

	/**
	 * When a transaction is updated.
	 *
	 * @param  \Ocs\Finance\Models\Transaction  $transaction
	 * @return mixed
	 */
	public function updated(Transaction $transaction);

	/**
	 * When a transaction is deleted.
	 *
	 * @param  \Ocs\Finance\Models\Transaction  $transaction
	 * @return mixed
	 */
	public function deleted(Transaction $transaction);

}
