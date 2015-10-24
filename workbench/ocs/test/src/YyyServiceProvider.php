<?php namespace Ocs\Test;

use Cartalyst\Support\ServiceProvider;

class YyyServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Test\Models\Yyy']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.test.yyy.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.test.yyy', 'Ocs\Test\Repositories\Yyy\YyyRepository');

		// Register the data handler
		$this->bindIf('ocs.test.yyy.handler.data', 'Ocs\Test\Handlers\Yyy\YyyDataHandler');

		// Register the event handler
		$this->bindIf('ocs.test.yyy.handler.event', 'Ocs\Test\Handlers\Yyy\YyyEventHandler');

		// Register the validator
		$this->bindIf('ocs.test.yyy.validator', 'Ocs\Test\Validator\Yyy\YyyValidator');
	}

}
