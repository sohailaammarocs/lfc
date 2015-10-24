<?php namespace Ocs\Standardforms;

use Cartalyst\Support\ServiceProvider;

class StanderedformsServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Standardforms\Models\Standeredforms']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.standardforms.standeredforms.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.standardforms.standeredforms', 'Ocs\Standardforms\Repositories\Standeredforms\StanderedformsRepository');

		// Register the data handler
		$this->bindIf('ocs.standardforms.standeredforms.handler.data', 'Ocs\Standardforms\Handlers\Standeredforms\StanderedformsDataHandler');

		// Register the event handler
		$this->bindIf('ocs.standardforms.standeredforms.handler.event', 'Ocs\Standardforms\Handlers\Standeredforms\StanderedformsEventHandler');

		// Register the validator
		$this->bindIf('ocs.standardforms.standeredforms.validator', 'Ocs\Standardforms\Validator\Standeredforms\StanderedformsValidator');
	}

}
