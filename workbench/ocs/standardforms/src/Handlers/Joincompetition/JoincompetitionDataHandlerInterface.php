<?php namespace Ocs\Standardforms\Handlers\Joincompetition;

interface JoincompetitionDataHandlerInterface {

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function prepare(array $data);

}
