<?php namespace Ocs\Standardforms\Handlers\Joincompetition;

use Illuminate\Events\Dispatcher;
use Ocs\Standardforms\Models\Joincompetition;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class JoincompetitionEventHandler extends BaseEventHandler implements JoincompetitionEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.standardforms.joincompetition.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.standardforms.joincompetition.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.standardforms.joincompetition.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.standardforms.joincompetition.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.standardforms.joincompetition.deleted', __CLASS__.'@deleted');
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
	public function created(Joincompetition $joincompetition)
	{
		$this->flushCache($joincompetition);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Joincompetition $joincompetition, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Joincompetition $joincompetition)
	{
		$this->flushCache($joincompetition);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Joincompetition $joincompetition)
	{
		$this->flushCache($joincompetition);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Standardforms\Models\Joincompetition  $joincompetition
	 * @return void
	 */
	protected function flushCache(Joincompetition $joincompetition)
	{
		$this->app['cache']->forget('ocs.standardforms.joincompetition.all');

		$this->app['cache']->forget('ocs.standardforms.joincompetition.'.$joincompetition->id);
	}

}
