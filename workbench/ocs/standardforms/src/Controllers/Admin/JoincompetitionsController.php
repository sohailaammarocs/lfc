<?php namespace Ocs\Standardforms\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Ocs\Standardforms\Repositories\Joincompetition\JoincompetitionRepositoryInterface;

class JoincompetitionsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Standardforms repository.
	 *
	 * @var \Ocs\Standardforms\Repositories\Joincompetition\JoincompetitionRepositoryInterface
	 */
	protected $joincompetitions;

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
	 * @param  \Ocs\Standardforms\Repositories\Joincompetition\JoincompetitionRepositoryInterface  $joincompetitions
	 * @return void
	 */
	public function __construct(JoincompetitionRepositoryInterface $joincompetitions)
	{
		parent::__construct();

		$this->joincompetitions = $joincompetitions;
	}

	/**
	 * Display a listing of joincompetition.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/standardforms::joincompetitions.index');
	}

	/**
	 * Datasource for the joincompetition Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->joincompetitions->grid();

		$columns = [
			'id',
			'team_name',
			'team_type',
			'competition_type',
			'message_box',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.ocs.standardforms.joincompetitions.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new joincompetition.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new joincompetition.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating joincompetition.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating joincompetition.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified joincompetition.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->joincompetitions->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("ocs/standardforms::joincompetitions/message.{$type}.delete")
		);

		return redirect()->route('admin.ocs.standardforms.joincompetitions.all');
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
				$this->joincompetitions->{$action}($row);
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
		// Do we have a joincompetition identifier?
		if (isset($id))
		{
			if ( ! $joincompetition = $this->joincompetitions->find($id))
			{
				$this->alerts->error(trans('ocs/standardforms::joincompetitions/message.not_found', compact('id')));

				return redirect()->route('admin.ocs.standardforms.joincompetitions.all');
			}
		}
		else
		{
			$joincompetition = $this->joincompetitions->createModel();
		}

		// Show the page
		return view('ocs/standardforms::joincompetitions.form', compact('mode', 'joincompetition'));
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
		// Store the joincompetition
		list($messages) = $this->joincompetitions->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("ocs/standardforms::joincompetitions/message.success.{$mode}"));

			return redirect()->route('admin.ocs.standardforms.joincompetitions.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
