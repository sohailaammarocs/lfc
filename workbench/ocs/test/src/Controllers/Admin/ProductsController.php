<?php namespace Ocs\Test\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Ocs\Test\Repositories\Products\ProductsRepositoryInterface;

class ProductsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Test repository.
	 *
	 * @var \Ocs\Test\Repositories\Products\ProductsRepositoryInterface
	 */
	protected $products;

	/**
	 * Holds all the mass actions we can execute.
	 *
	 * @var array
	 */
	protected $actions = [
		'delete',
		'enable',
		'disable',
	];

	/**
	 * Constructor.
	 *
	 * @param  \Ocs\Test\Repositories\Products\ProductsRepositoryInterface  $products
	 * @return void
	 */
	public function __construct(ProductsRepositoryInterface $products)
	{
		parent::__construct();

		$this->products = $products;
	}

	/**
	 * Display a listing of products.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/test::products.index');
	}

	/**
	 * Datasource for the products Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->products->grid();

		$columns = [
			'id',
			'name',
			'image',
			'price',
			'desc',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.ocs.test.products.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new products.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new products.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating products.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating products.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified products.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->products->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("ocs/test::products/message.{$type}.delete")
		);

		return redirect()->route('admin.ocs.test.products.all');
	}

	/**
	 * Executes the mass action.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function executeAction()
	{
		$action = request()->input('action');

		if (in_array($action, $this->actions))
		{
			foreach (request()->input('rows', []) as $row)
			{
				$this->products->{$action}($row);
			}

			return response('Success');
		}

		return response('Failed', 500);
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		// Do we have a products identifier?
		if (isset($id))
		{
			if ( ! $products = $this->products->find($id))
			{
				$this->alerts->error(trans('ocs/test::products/message.not_found', compact('id')));

				return redirect()->route('admin.ocs.test.products.all');
			}
		}
		else
		{
			$products = $this->products->createModel();
		}

		// Show the page
		return view('ocs/test::products.form', compact('mode', 'products'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		// Store the products
		list($messages) = $this->products->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("ocs/test::products/message.success.{$mode}"));

			return redirect()->route('admin.ocs.test.products.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
