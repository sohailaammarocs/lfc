<?php namespace Ocs\Standardforms\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Ocs\Standardforms\Repositories\Contactusform\ContactusformRepositoryInterface;

class ContactusformsController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Standardforms repository.
	 *
	 * @var \Ocs\Standardforms\Repositories\Contactusform\ContactusformRepositoryInterface
	 */
	protected $contactusforms;

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
	 * @param  \Ocs\Standardforms\Repositories\Contactusform\ContactusformRepositoryInterface  $contactusforms
	 * @return void
	 */
	public function __construct(ContactusformRepositoryInterface $contactusforms)
	{
		parent::__construct();

		$this->contactusforms = $contactusforms;
	}

	/**
	 * Display a listing of contactusform.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('ocs/standardforms::contactusforms.index');
	}

	/**
	 * Datasource for the contactusform Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->contactusforms->grid();

		$columns = [
			'id',
			'first_name',
			'last_name',
			'gender',
			'work_phone',
			'mobile',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.ocs.standardforms.contactusforms.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new contactusform.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new contactusform.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating contactusform.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating contactusform.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified contactusform.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->contactusforms->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("ocs/standardforms::contactusforms/message.{$type}.delete")
		);

		return redirect()->route('admin.ocs.standardforms.contactusforms.all');
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
				$this->contactusforms->{$action}($row);
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
		// Do we have a contactusform identifier?
		if (isset($id))
		{
			if ( ! $contactusform = $this->contactusforms->find($id))
			{
				$this->alerts->error(trans('ocs/standardforms::contactusforms/message.not_found', compact('id')));

				return redirect()->route('admin.ocs.standardforms.contactusforms.all');
			}
		}
		else
		{
			$contactusform = $this->contactusforms->createModel();
		}

		// Show the page
		return view('ocs/standardforms::contactusforms.form', compact('mode', 'contactusform'));
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
		// Store the contactusform
		list($messages) = $this->contactusforms->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("ocs/standardforms::contactusforms/message.success.{$mode}"));

			return redirect()->route('admin.ocs.standardforms.contactusforms.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
