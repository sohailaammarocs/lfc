<?php namespace Ocs\Standardforms\Repositories\Standeredforms;

interface StanderedformsRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Ocs\Standardforms\Models\Standeredforms
	 */
	public function grid();

	/**
	 * Returns all the standardforms entries.
	 *
	 * @return \Ocs\Standardforms\Models\Standeredforms
	 */
	public function findAll();

	/**
	 * Returns a standardforms entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Ocs\Standardforms\Models\Standeredforms
	 */
	public function find($id);

	/**
	 * Determines if the given standardforms is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given standardforms is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given standardforms.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a standardforms entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Ocs\Standardforms\Models\Standeredforms
	 */
	public function create(array $data);

	/**
	 * Updates the standardforms entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Ocs\Standardforms\Models\Standeredforms
	 */
	public function update($id, array $data);

	/**
	 * Deletes the standardforms entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
