<?php namespace Ocs\Test\Handlers\Products;

use Ocs\Test\Models\Products;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface ProductsEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a products is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a products is created.
	 *
	 * @param  \Ocs\Test\Models\Products  $products
	 * @return mixed
	 */
	public function created(Products $products);

	/**
	 * When a products is being updated.
	 *
	 * @param  \Ocs\Test\Models\Products  $products
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Products $products, array $data);

	/**
	 * When a products is updated.
	 *
	 * @param  \Ocs\Test\Models\Products  $products
	 * @return mixed
	 */
	public function updated(Products $products);

	/**
	 * When a products is deleted.
	 *
	 * @param  \Ocs\Test\Models\Products  $products
	 * @return mixed
	 */
	public function deleted(Products $products);

}
