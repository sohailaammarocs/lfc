<?php namespace Ocs\Finance\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Ocs\Finance\Repositories\Statement\StatementRepositoryInterface;

class StatementsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Finance repository.
	 *
	 * @var \Ocs\Finance\Repositories\Statement\StatementRepositoryInterface
	 */
	protected $statements;

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
	 * @param  \Ocs\Finance\Repositories\Statement\StatementRepositoryInterface  $statements
	 * @return void
	 */
	public function __construct(StatementRepositoryInterface $statements)
	{
		parent::__construct();

		$this->statements = $statements;
	}

	/**
	 * Display a listing of statement.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/finance::statements.index');
	}

	/**
	 * Datasource for the statement Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->statements->grid();

		$columns = [
			'id',
			'Date',
			'Description',
			'Money_in',
			'Money_out ',
			'Balance',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.ocs.finance.statements.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new statement.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new statement.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating statement.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating statement.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified statement.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->statements->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("ocs/finance::statements/message.{$type}.delete")
		);

		return redirect()->route('admin.ocs.finance.statements.all');
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
				$this->statements->{$action}($row);
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
		// Do we have a statement identifier?
		if (isset($id))
		{
			if ( ! $statement = $this->statements->find($id))
			{
				$this->alerts->error(trans('ocs/finance::statements/message.not_found', compact('id')));

				return redirect()->route('admin.ocs.finance.statements.all');
			}
		}
		else
		{
			$statement = $this->statements->createModel();
		}

		// Show the page
		return view('ocs/finance::statements.form', compact('mode', 'statement'));
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
		// Store the statement
		list($messages) = $this->statements->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("ocs/finance::statements/message.success.{$mode}"));

			return redirect()->route('admin.ocs.finance.statements.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
