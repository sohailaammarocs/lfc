<?php namespace Ocs\Finance\Repositories\Transaction;

interface TransactionRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Ocs\Finance\Models\Transaction
	 */
	public function grid();

	/**
	 * Returns all the finance entries.
	 *
	 * @return \Ocs\Finance\Models\Transaction
	 */
	public function findAll();

	/**
	 * Returns a finance entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Ocs\Finance\Models\Transaction
	 */
	public function find($id);

	/**
	 * Determines if the given finance is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given finance is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given finance.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a finance entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Ocs\Finance\Models\Transaction
	 */
	public function create(array $data);

	/**
	 * Updates the finance entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Ocs\Finance\Models\Transaction
	 */
	public function update($id, array $data);

	/**
	 * Deletes the finance entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
