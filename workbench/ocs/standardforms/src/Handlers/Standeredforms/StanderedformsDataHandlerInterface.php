<?php namespace Ocs\Standardforms\Handlers\Standeredforms;

interface StanderedformsDataHandlerInterface {

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function prepare(array $data);

}
