<?php namespace Ocs\Standardforms\Handlers\Standeredforms;

use Ocs\Standardforms\Models\Standeredforms;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface StanderedformsEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a standeredforms is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a standeredforms is created.
	 *
	 * @param  \Ocs\Standardforms\Models\Standeredforms  $standeredforms
	 * @return mixed
	 */
	public function created(Standeredforms $standeredforms);

	/**
	 * When a standeredforms is being updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Standeredforms  $standeredforms
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Standeredforms $standeredforms, array $data);

	/**
	 * When a standeredforms is updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Standeredforms  $standeredforms
	 * @return mixed
	 */
	public function updated(Standeredforms $standeredforms);

	/**
	 * When a standeredforms is deleted.
	 *
	 * @param  \Ocs\Standardforms\Models\Standeredforms  $standeredforms
	 * @return mixed
	 */
	public function deleted(Standeredforms $standeredforms);

}
