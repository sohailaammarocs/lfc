<?php namespace Ocs\Test\Repositories\Yyy;

interface YyyRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Ocs\Test\Models\Yyy
	 */
	public function grid();

	/**
	 * Returns all the test entries.
	 *
	 * @return \Ocs\Test\Models\Yyy
	 */
	public function findAll();

	/**
	 * Returns a test entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Ocs\Test\Models\Yyy
	 */
	public function find($id);

	/**
	 * Determines if the given test is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given test is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given test.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a test entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Ocs\Test\Models\Yyy
	 */
	public function create(array $data);

	/**
	 * Updates the test entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Ocs\Test\Models\Yyy
	 */
	public function update($id, array $data);

	/**
	 * Deletes the test entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
