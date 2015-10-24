<?php namespace Ocs\Standardforms\Handlers\Standeredforms;

use Illuminate\Events\Dispatcher;
use Ocs\Standardforms\Models\Standeredforms;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class StanderedformsEventHandler extends BaseEventHandler implements StanderedformsEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.standardforms.standeredforms.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.standardforms.standeredforms.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.standardforms.standeredforms.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.standardforms.standeredforms.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.standardforms.standeredforms.deleted', __CLASS__.'@deleted');
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
	public function created(Standeredforms $standeredforms)
	{
		$this->flushCache($standeredforms);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Standeredforms $standeredforms, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Standeredforms $standeredforms)
	{
		$this->flushCache($standeredforms);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Standeredforms $standeredforms)
	{
		$this->flushCache($standeredforms);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Standardforms\Models\Standeredforms  $standeredforms
	 * @return void
	 */
	protected function flushCache(Standeredforms $standeredforms)
	{
		$this->app['cache']->forget('ocs.standardforms.standeredforms.all');

		$this->app['cache']->forget('ocs.standardforms.standeredforms.'.$standeredforms->id);
	}

}
