<?php namespace Ocs\Test\Handlers\Products;

class ProductsDataHandler implements ProductsDataHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function prepare(array $data)
	{
		return $data;
	}

}
