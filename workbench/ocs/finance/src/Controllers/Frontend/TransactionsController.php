<?php namespace Ocs\Finance\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class TransactionsController extends Controller {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/finance::index');
	}

}
