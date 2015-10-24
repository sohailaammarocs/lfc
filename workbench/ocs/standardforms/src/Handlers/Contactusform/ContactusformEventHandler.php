<?php namespace Ocs\Standardforms\Handlers\Contactusform;

use Illuminate\Events\Dispatcher;
use Ocs\Standardforms\Models\Contactusform;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class ContactusformEventHandler extends BaseEventHandler implements ContactusformEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.standardforms.contactusform.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.standardforms.contactusform.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.standardforms.contactusform.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.standardforms.contactusform.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.standardforms.contactusform.deleted', __CLASS__.'@deleted');
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
	public function created(Contactusform $contactusform)
	{
		$this->flushCache($contactusform);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Contactusform $contactusform, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Contactusform $contactusform)
	{
		$this->flushCache($contactusform);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Contactusform $contactusform)
	{
		$this->flushCache($contactusform);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Standardforms\Models\Contactusform  $contactusform
	 * @return void
	 */
	protected function flushCache(Contactusform $contactusform)
	{
		$this->app['cache']->forget('ocs.standardforms.contactusform.all');

		$this->app['cache']->forget('ocs.standardforms.contactusform.'.$contactusform->id);
	}

}
