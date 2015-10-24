<?php namespace Ocs\Test;

use Cartalyst\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Test\Models\Products']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.test.products.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.test.products', 'Ocs\Test\Repositories\Products\ProductsRepository');

		// Register the data handler
		$this->bindIf('ocs.test.products.handler.data', 'Ocs\Test\Handlers\Products\ProductsDataHandler');

		// Register the event handler
		$this->bindIf('ocs.test.products.handler.event', 'Ocs\Test\Handlers\Products\ProductsEventHandler');

		// Register the validator
		$this->bindIf('ocs.test.products.validator', 'Ocs\Test\Validator\Products\ProductsValidator');
	}

}
