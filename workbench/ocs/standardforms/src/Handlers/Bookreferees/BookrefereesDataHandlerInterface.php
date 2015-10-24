<?php namespace Ocs\Standardforms\Handlers\Bookreferees;

interface BookrefereesDataHandlerInterface {

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function prepare(array $data);

}
