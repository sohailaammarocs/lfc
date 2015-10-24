<?php namespace Ocs\Test\Handlers\Products;

use Illuminate\Events\Dispatcher;
use Ocs\Test\Models\Products;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class ProductsEventHandler extends BaseEventHandler implements ProductsEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('ocs.test.products.creating', __CLASS__.'@creating');
		$dispatcher->listen('ocs.test.products.created', __CLASS__.'@created');

		$dispatcher->listen('ocs.test.products.updating', __CLASS__.'@updating');
		$dispatcher->listen('ocs.test.products.updated', __CLASS__.'@updated');

		$dispatcher->listen('ocs.test.products.deleted', __CLASS__.'@deleted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function creating(array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function created(Products $products)
	{
		$this->flushCache($products);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Products $products, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Products $products)
	{
		$this->flushCache($products);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Products $products)
	{
		$this->flushCache($products);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Ocs\Test\Models\Products  $products
	 * @return void
	 */
	protected function flushCache(Products $products)
	{
		$this->app['cache']->forget('ocs.test.products.all');

		$this->app['cache']->forget('ocs.test.products.'.$products->id);
	}

}
