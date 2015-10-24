<?php namespace Ocs\Test\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class ProductsController extends Controller {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/test::index');
	}

}
