<?php namespace Ocs\Standardforms\Repositories\Bookreferees;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Standardforms\Models\Bookreferees;

class BookrefereesRepository implements BookrefereesRepositoryInterface {

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

		$this->data = $app['ocs.standardforms.bookreferees.handler.data'];

		$this->setValidator($app['ocs.standardforms.bookreferees.validator']);

		$this->setModel(get_class($app['Ocs\Standardforms\Models\Bookreferees']));
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
		return $this->container['cache']->rememberForever('ocs.standardforms.bookreferees.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.standardforms.bookreferees.'.$id, function() use ($id)
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
		// Create a new bookreferees
		$bookreferees = $this->createModel();

		// Fire the 'ocs.standardforms.bookreferees.creating' event
		if ($this->fireEvent('ocs.standardforms.bookreferees.creating', [ $input ]) === false)
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
			// Save the bookreferees
			$bookreferees->fill($data)->save();

			// Fire the 'ocs.standardforms.bookreferees.created' event
			$this->fireEvent('ocs.standardforms.bookreferees.created', [ $bookreferees ]);
		}

		return [ $messages, $bookreferees ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the bookreferees object
		$bookreferees = $this->find($id);

		// Fire the 'ocs.standardforms.bookreferees.updating' event
		if ($this->fireEvent('ocs.standardforms.bookreferees.updating', [ $bookreferees, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($bookreferees, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the bookreferees
			$bookreferees->fill($data)->save();

			// Fire the 'ocs.standardforms.bookreferees.updated' event
			$this->fireEvent('ocs.standardforms.bookreferees.updated', [ $bookreferees ]);
		}

		return [ $messages, $bookreferees ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the bookreferees exists
		if ($bookreferees = $this->find($id))
		{
			// Fire the 'ocs.standardforms.bookreferees.deleted' event
			$this->fireEvent('ocs.standardforms.bookreferees.deleted', [ $bookreferees ]);

			// Delete the bookreferees entry
			$bookreferees->delete();

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
