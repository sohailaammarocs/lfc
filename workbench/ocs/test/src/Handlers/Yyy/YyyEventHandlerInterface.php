<?php namespace Ocs\Test\Handlers\Yyy;

use Ocs\Test\Models\Yyy;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface YyyEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a yyy is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a yyy is created.
	 *
	 * @param  \Ocs\Test\Models\Yyy  $yyy
	 * @return mixed
	 */
	public function created(Yyy $yyy);

	/**
	 * When a yyy is being updated.
	 *
	 * @param  \Ocs\Test\Models\Yyy  $yyy
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Yyy $yyy, array $data);

	/**
	 * When a yyy is updated.
	 *
	 * @param  \Ocs\Test\Models\Yyy  $yyy
	 * @return mixed
	 */
	public function updated(Yyy $yyy);

	/**
	 * When a yyy is deleted.
	 *
	 * @param  \Ocs\Test\Models\Yyy  $yyy
	 * @return mixed
	 */
	public function deleted(Yyy $yyy);

}
