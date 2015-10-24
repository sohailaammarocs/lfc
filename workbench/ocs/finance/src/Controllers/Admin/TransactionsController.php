<?php namespace Ocs\Finance\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Ocs\Finance\Repositories\Transaction\TransactionRepositoryInterface;

class TransactionsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Finance repository.
	 *
	 * @var \Ocs\Finance\Repositories\Transaction\TransactionRepositoryInterface
	 */
	protected $transactions;

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
	 * @param  \Ocs\Finance\Repositories\Transaction\TransactionRepositoryInterface  $transactions
	 * @return void
	 */
	public function __construct(TransactionRepositoryInterface $transactions)
	{
		parent::__construct();

		$this->transactions = $transactions;
	}

	/**
	 * Display a listing of transaction.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/finance::transactions.index');
	}

	/**
	 * Datasource for the transaction Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->transactions->grid();

		$columns = [
			'id',
			'Company',
			'Calendar',
			'Amount',
			'Type',
			'Paid_By',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.ocs.finance.transactions.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new transaction.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new transaction.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating transaction.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating transaction.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified transaction.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->transactions->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("ocs/finance::transactions/message.{$type}.delete")
		);

		return redirect()->route('admin.ocs.finance.transactions.all');
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
				$this->transactions->{$action}($row);
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
		// Do we have a transaction identifier?
		if (isset($id))
		{
			if ( ! $transaction = $this->transactions->find($id))
			{
				$this->alerts->error(trans('ocs/finance::transactions/message.not_found', compact('id')));

				return redirect()->route('admin.ocs.finance.transactions.all');
			}
		}
		else
		{
			$transaction = $this->transactions->createModel();
		}

		// Show the page
		return view('ocs/finance::transactions.form', compact('mode', 'transaction'));
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
		// Store the transaction
		list($messages) = $this->transactions->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("ocs/finance::transactions/message.success.{$mode}"));

			return redirect()->route('admin.ocs.finance.transactions.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
