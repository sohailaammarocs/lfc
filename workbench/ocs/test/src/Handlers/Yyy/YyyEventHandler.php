<?php namespace Ocs\Test\Handlers\Yyy;

use Illuminate\Events\Dispatcher;
use Ocs\Test\Models\Yyy;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class YyyEventHandler extends BaseEventHandler implements YyyEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.test.yyy.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.test.yyy.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.test.yyy.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.test.yyy.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.test.yyy.deleted', __CLASS__.'@deleted');
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
	public function created(Yyy $yyy)
	{
		$this->flushCache($yyy);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Yyy $yyy, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Yyy $yyy)
	{
		$this->flushCache($yyy);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Yyy $yyy)
	{
		$this->flushCache($yyy);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Test\Models\Yyy  $yyy
	 * @return void
	 */
	protected function flushCache(Yyy $yyy)
	{
		$this->app['cache']->forget('ocs.test.yyy.all');

		$this->app['cache']->forget('ocs.test.yyy.'.$yyy->id);
	}

}
