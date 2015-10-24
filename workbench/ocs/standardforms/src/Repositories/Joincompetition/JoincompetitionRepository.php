<?php namespace Ocs\Standardforms\Repositories\Joincompetition;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Standardforms\Models\Joincompetition;

class JoincompetitionRepository implements JoincompetitionRepositoryInterface {

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

		$this->data = $app['ocs.standardforms.joincompetition.handler.data'];

		$this->setValidator($app['ocs.standardforms.joincompetition.validator']);

		$this->setModel(get_class($app['Ocs\Standardforms\Models\Joincompetition']));
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
		return $this->container['cache']->rememberForever('ocs.standardforms.joincompetition.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.standardforms.joincompetition.'.$id, function() use ($id)
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
		// Create a new joincompetition
		$joincompetition = $this->createModel();

		// Fire the 'ocs.standardforms.joincompetition.creating' event
		if ($this->fireEvent('ocs.standardforms.joincompetition.creating', [ $input ]) === false)
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
			// Save the joincompetition
			$joincompetition->fill($data)->save();

			// Fire the 'ocs.standardforms.joincompetition.created' event
			$this->fireEvent('ocs.standardforms.joincompetition.created', [ $joincompetition ]);
		}

		return [ $messages, $joincompetition ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the joincompetition object
		$joincompetition = $this->find($id);

		// Fire the 'ocs.standardforms.joincompetition.updating' event
		if ($this->fireEvent('ocs.standardforms.joincompetition.updating', [ $joincompetition, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($joincompetition, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the joincompetition
			$joincompetition->fill($data)->save();

			// Fire the 'ocs.standardforms.joincompetition.updated' event
			$this->fireEvent('ocs.standardforms.joincompetition.updated', [ $joincompetition ]);
		}

		return [ $messages, $joincompetition ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the joincompetition exists
		if ($joincompetition = $this->find($id))
		{
			// Fire the 'ocs.standardforms.joincompetition.deleted' event
			$this->fireEvent('ocs.standardforms.joincompetition.deleted', [ $joincompetition ]);

			// Delete the joincompetition entry
			$joincompetition->delete();

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
