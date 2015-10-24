<?php namespace Ocs\Standardforms\Handlers\Joincompetition;

use Ocs\Standardforms\Models\Joincompetition;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface JoincompetitionEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a joincompetition is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a joincompetition is created.
	 *
	 * @param  \Ocs\Standardforms\Models\Joincompetition  $joincompetition
	 * @return mixed
	 */
	public function created(Joincompetition $joincompetition);

	/**
	 * When a joincompetition is being updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Joincompetition  $joincompetition
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Joincompetition $joincompetition, array $data);

	/**
	 * When a joincompetition is updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Joincompetition  $joincompetition
	 * @return mixed
	 */
	public function updated(Joincompetition $joincompetition);

	/**
	 * When a joincompetition is deleted.
	 *
	 * @param  \Ocs\Standardforms\Models\Joincompetition  $joincompetition
	 * @return mixed
	 */
	public function deleted(Joincompetition $joincompetition);

}
