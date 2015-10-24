<?php namespace Ocs\Standardforms;

use Cartalyst\Support\ServiceProvider;

class ContactusformServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Ocs\Standardforms\Models\Contactusform']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('ocs.standardforms.contactusform.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('ocs.standardforms.contactusform', 'Ocs\Standardforms\Repositories\Contactusform\ContactusformRepository');

		// Register the data handler
		$this->bindIf('ocs.standardforms.contactusform.handler.data', 'Ocs\Standardforms\Handlers\Contactusform\ContactusformDataHandler');

		// Register the event handler
		$this->bindIf('ocs.standardforms.contactusform.handler.event', 'Ocs\Standardforms\Handlers\Contactusform\ContactusformEventHandler');

		// Register the validator
		$this->bindIf('ocs.standardforms.contactusform.validator', 'Ocs\Standardforms\Validator\Contactusform\ContactusformValidator');
	}

}
