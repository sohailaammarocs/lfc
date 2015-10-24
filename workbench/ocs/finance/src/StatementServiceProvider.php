<?php namespace Ocs\Finance;

use Cartalyst\Support\ServiceProvider;

class StatementServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Finance\Models\Statement']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.finance.statement.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.finance.statement', 'Ocs\Finance\Repositories\Statement\StatementRepository');

		// Register the data handler
		$this->bindIf('ocs.finance.statement.handler.data', 'Ocs\Finance\Handlers\Statement\StatementDataHandler');

		// Register the event handler
		$this->bindIf('ocs.finance.statement.handler.event', 'Ocs\Finance\Handlers\Statement\StatementEventHandler');

		// Register the validator
		$this->bindIf('ocs.finance.statement.validator', 'Ocs\Finance\Validator\Statement\StatementValidator');
	}

}
