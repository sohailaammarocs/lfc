<?php namespace Ocs\Standardforms\Handlers\Contactusform;

use Ocs\Standardforms\Models\Contactusform;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface ContactusformEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a contactusform is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a contactusform is created.
	 *
	 * @param  \Ocs\Standardforms\Models\Contactusform  $contactusform
	 * @return mixed
	 */
	public function created(Contactusform $contactusform);

	/**
	 * When a contactusform is being updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Contactusform  $contactusform
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Contactusform $contactusform, array $data);

	/**
	 * When a contactusform is updated.
	 *
	 * @param  \Ocs\Standardforms\Models\Contactusform  $contactusform
	 * @return mixed
	 */
	public function updated(Contactusform $contactusform);

	/**
	 * When a contactusform is deleted.
	 *
	 * @param  \Ocs\Standardforms\Models\Contactusform  $contactusform
	 * @return mixed
	 */
	public function deleted(Contactusform $contactusform);

}
