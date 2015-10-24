<?php namespace Ocs\Standardforms\Repositories\Standeredforms;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Standardforms\Models\Standeredforms;

class StanderedformsRepository implements StanderedformsRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Ocs\Standardforms\Handlers\DataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent standardforms model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$this->setContainer($app);

		$this->setDispatcher($app['events']);

		$this->data = $app['ocs.standardforms.standeredforms.handler.data'];

		$this->setValidator($app['ocs.standardforms.standeredforms.validator']);

		$this->setModel(get_class($app['Ocs\Standardforms\Models\Standeredforms']));
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this->container['cache']->rememberForever('ocs.standardforms.standeredforms.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.standardforms.standeredforms.'.$id, function() use ($id)
		{
			return $this->createModel()->find($id);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $input)
	{
		return $this->validator->on('create')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $input)
	{
		return $this->validator->on('update')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new standeredforms
		$standeredforms = $this->createModel();

		// Fire the 'ocs.standardforms.standeredforms.creating' event
		if ($this->fireEvent('ocs.standardforms.standeredforms.creating', [ $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForCreation($data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the standeredforms
			$standeredforms->fill($data)->save();

			// Fire the 'ocs.standardforms.standeredforms.created' event
			$this->fireEvent('ocs.standardforms.standeredforms.created', [ $standeredforms ]);
		}

		return [ $messages, $standeredforms ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the standeredforms object
		$standeredforms = $this->find($id);

		// Fire the 'ocs.standardforms.standeredforms.updating' event
		if ($this->fireEvent('ocs.standardforms.standeredforms.updating', [ $standeredforms, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($standeredforms, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the standeredforms
			$standeredforms->fill($data)->save();

			// Fire the 'ocs.standardforms.standeredforms.updated' event
			$this->fireEvent('ocs.standardforms.standeredforms.updated', [ $standeredforms ]);
		}

		return [ $messages, $standeredforms ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the standeredforms exists
		if ($standeredforms = $this->find($id))
		{
			// Fire the 'ocs.standardforms.standeredforms.deleted' event
			$this->fireEvent('ocs.standardforms.standeredforms.deleted', [ $standeredforms ]);

			// Delete the standeredforms entry
			$standeredforms->delete();

			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function enable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => true ]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function disable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => false ]);
	}

}
