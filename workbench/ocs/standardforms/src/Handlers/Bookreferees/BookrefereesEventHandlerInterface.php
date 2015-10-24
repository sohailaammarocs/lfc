<?php namespace Ocs\Standardforms\Handlers\Bookreferees;

use Ocs\Standardforms\Models\Bookreferees;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface BookrefereesEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a bookreferees is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a bookreferees is created.
	 *
	 * @param  \Ocs\Standardforms\Models\Bookreferees  $bookreferees
	 * @return mixed
	 */
	public function created(Bookreferees $bookreferees);

	/**
	 * When a bookreferees is being updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Bookreferees  $bookreferees
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Bookreferees $bookreferees, array $data);

	/**
	 * When a bookreferees is updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Bookreferees  $bookreferees
	 * @return mixed
	 */
	public function updated(Bookreferees $bookreferees);

	/**
	 * When a bookreferees is deleted.
	 *
	 * @param  \Ocs\Standardforms\Models\Bookreferees  $bookreferees
	 * @return mixed
	 */
	public function deleted(Bookreferees $bookreferees);

}
