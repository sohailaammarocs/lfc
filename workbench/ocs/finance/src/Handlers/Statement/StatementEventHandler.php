<?php namespace Ocs\Finance\Handlers\Statement;

use Illuminate\Events\Dispatcher;
use Ocs\Finance\Models\Statement;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class StatementEventHandler extends BaseEventHandler implements StatementEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.finance.statement.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.finance.statement.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.finance.statement.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.finance.statement.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.finance.statement.deleted', __CLASS__.'@deleted');
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
	public function created(Statement $statement)
	{
		$this->flushCache($statement);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Statement $statement, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Statement $statement)
	{
		$this->flushCache($statement);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Statement $statement)
	{
		$this->flushCache($statement);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Finance\Models\Statement  $statement
	 * @return void
	 */
	protected function flushCache(Statement $statement)
	{
		$this->app['cache']->forget('ocs.finance.statement.all');

		$this->app['cache']->forget('ocs.finance.statement.'.$statement->id);
	}

}
