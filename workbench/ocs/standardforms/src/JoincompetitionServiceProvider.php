<?php namespace Ocs\Standardforms;

use Cartalyst\Support\ServiceProvider;

class JoincompetitionServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Standardforms\Models\Joincompetition']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.standardforms.joincompetition.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.standardforms.joincompetition', 'Ocs\Standardforms\Repositories\Joincompetition\JoincompetitionRepository');

		// Register the data handler
		$this->bindIf('ocs.standardforms.joincompetition.handler.data', 'Ocs\Standardforms\Handlers\Joincompetition\JoincompetitionDataHandler');

		// Register the event handler
		$this->bindIf('ocs.standardforms.joincompetition.handler.event', 'Ocs\Standardforms\Handlers\Joincompetition\JoincompetitionEventHandler');

		// Register the validator
		$this->bindIf('ocs.standardforms.joincompetition.validator', 'Ocs\Standardforms\Validator\Joincompetition\JoincompetitionValidator');
	}

}
