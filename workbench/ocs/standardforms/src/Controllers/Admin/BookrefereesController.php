<?php namespace Ocs\Standardforms\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Ocs\Standardforms\Repositories\Bookreferees\BookrefereesRepositoryInterface;

class BookrefereesController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Standardforms repository.
	 *
	 * @var \Ocs\Standardforms\Repositories\Bookreferees\BookrefereesRepositoryInterface
	 */
	protected $bookreferees;

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
	 * @param  \Ocs\Standardforms\Repositories\Bookreferees\BookrefereesRepositoryInterface  $bookreferees
	 * @return void
	 */
	public function __construct(BookrefereesRepositoryInterface $bookreferees)
	{
		parent::__construct();

		$this->bookreferees = $bookreferees;
	}

	/**
	 * Display a listing of bookreferees.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/standardforms::bookreferees.index');
	}

	/**
	 * Datasource for the bookreferees Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->bookreferees->grid();

		$columns = [
			'id',
			'team_name',
			'team_type',
			'opponent_first_name',
			'opponent_last_name',
			'opponent_work_phone',
			'opponent_mobile',
			'opponent_email_address',
			'opponent_team_name',
			'match_gender',
			'referees',
			'assistant_refrees',
			'fixture',
			'fixture_type',
			'competition_name',
			'match_duration',
			'match_start',
			'match_end',
			'fixture_date',
			'pitch_surface',
			'venue',
			'message',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.ocs.standardforms.bookreferees.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new bookreferees.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new bookreferees.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating bookreferees.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating bookreferees.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified bookreferees.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->bookreferees->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("ocs/standardforms::bookreferees/message.{$type}.delete")
		);

		return redirect()->route('admin.ocs.standardforms.bookreferees.all');
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
				$this->bookreferees->{$action}($row);
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
		// Do we have a bookreferees identifier?
		if (isset($id))
		{
			if ( ! $bookreferees = $this->bookreferees->find($id))
			{
				$this->alerts->error(trans('ocs/standardforms::bookreferees/message.not_found', compact('id')));

				return redirect()->route('admin.ocs.standardforms.bookreferees.all');
			}
		}
		else
		{
			$bookreferees = $this->bookreferees->createModel();
		}

		// Show the page
		return view('ocs/standardforms::bookreferees.form', compact('mode', 'bookreferees'));
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
		// Store the bookreferees
		list($messages) = $this->bookreferees->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("ocs/standardforms::bookreferees/message.success.{$mode}"));

			return redirect()->route('admin.ocs.standardforms.bookreferees.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
