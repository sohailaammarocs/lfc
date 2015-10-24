<?php namespace Ocs\Standardforms\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class ContactusformsController extends Controller {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/standardforms::index');
	}

}
