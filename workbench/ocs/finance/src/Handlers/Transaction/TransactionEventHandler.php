<?php namespace Ocs\Finance\Handlers\Transaction;

use Illuminate\Events\Dispatcher;
use Ocs\Finance\Models\Transaction;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class TransactionEventHandler extends BaseEventHandler implements TransactionEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.finance.transaction.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.finance.transaction.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.finance.transaction.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.finance.transaction.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.finance.transaction.deleted', __CLASS__.'@deleted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function creating(array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function created(Transaction $transaction)
	{
		$this->flushCache($transaction);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Transaction $transaction, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Transaction $transaction)
	{
		$this->flushCache($transaction);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Transaction $transaction)
	{
		$this->flushCache($transaction);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Finance\Models\Transaction  $transaction
	 * @return void
	 */
	protected function flushCache(Transaction $transaction)
	{
		$this->app['cache']->forget('ocs.finance.transaction.all');

		$this->app['cache']->forget('ocs.finance.transaction.'.$transaction->id);
	}

}
