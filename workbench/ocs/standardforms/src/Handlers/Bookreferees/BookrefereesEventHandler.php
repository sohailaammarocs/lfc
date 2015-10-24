<?php namespace Ocs\Standardforms\Handlers\Bookreferees;

use Illuminate\Events\Dispatcher;
use Ocs\Standardforms\Models\Bookreferees;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class BookrefereesEventHandler extends BaseEventHandler implements BookrefereesEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.standardforms.bookreferees.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.standardforms.bookreferees.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.standardforms.bookreferees.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.standardforms.bookreferees.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.standardforms.bookreferees.deleted', __CLASS__.'@deleted');
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
	public function created(Bookreferees $bookreferees)
	{
		$this->flushCache($bookreferees);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Bookreferees $bookreferees, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Bookreferees $bookreferees)
	{
		$this->flushCache($bookreferees);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Bookreferees $bookreferees)
	{
		$this->flushCache($bookreferees);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Standardforms\Models\Bookreferees  $bookreferees
	 * @return void
	 */
	protected function flushCache(Bookreferees $bookreferees)
	{
		$this->app['cache']->forget('ocs.standardforms.bookreferees.all');

		$this->app['cache']->forget('ocs.standardforms.bookreferees.'.$bookreferees->id);
	}

}
