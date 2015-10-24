<?php namespace Ocs\Finance\Handlers\Statement;

use Ocs\Finance\Models\Statement;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface StatementEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a statement is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a statement is created.
	 *
	 * @param  \Ocs\Finance\Models\Statement  $statement
	 * @return mixed
	 */
	public function created(Statement $statement);

	/**
	 * When a statement is being updated.
	 *
	 * @param  \Ocs\Finance\Models\Statement  $statement
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Statement $statement, array $data);

	/**
	 * When a statement is updated.
	 *
	 * @param  \Ocs\Finance\Models\Statement  $statement
	 * @return mixed
	 */
	public function updated(Statement $statement);

	/**
	 * When a statement is deleted.
	 *
	 * @param  \Ocs\Finance\Models\Statement  $statement
	 * @return mixed
	 */
	public function deleted(Statement $statement);

}
