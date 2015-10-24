<?php namespace Ocs\Standardforms;

use Cartalyst\Support\ServiceProvider;

class BookrefereesServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Standardforms\Models\Bookreferees']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.standardforms.bookreferees.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.standardforms.bookreferees', 'Ocs\Standardforms\Repositories\Bookreferees\BookrefereesRepository');

		// Register the data handler
		$this->bindIf('ocs.standardforms.bookreferees.handler.data', 'Ocs\Standardforms\Handlers\Bookreferees\BookrefereesDataHandler');

		// Register the event handler
		$this->bindIf('ocs.standardforms.bookreferees.handler.event', 'Ocs\Standardforms\Handlers\Bookreferees\BookrefereesEventHandler');

		// Register the validator
		$this->bindIf('ocs.standardforms.bookreferees.validator', 'Ocs\Standardforms\Validator\Bookreferees\BookrefereesValidator');
	}

}
