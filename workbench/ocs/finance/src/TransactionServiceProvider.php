<?php namespace Ocs\Finance;

use Cartalyst\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Finance\Models\Transaction']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.finance.transaction.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.finance.transaction', 'Ocs\Finance\Repositories\Transaction\TransactionRepository');

		// Register the data handler
		$this->bindIf('ocs.finance.transaction.handler.data', 'Ocs\Finance\Handlers\Transaction\TransactionDataHandler');

		// Register the event handler
		$this->bindIf('ocs.finance.transaction.handler.event', 'Ocs\Finance\Handlers\Transaction\TransactionEventHandler');

		// Register the validator
		$this->bindIf('ocs.finance.transaction.validator', 'Ocs\Finance\Validator\Transaction\TransactionValidator');
	}

}
