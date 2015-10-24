<?php namespace Ocs\Test\Repositories\Yyy;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Test\Models\Yyy;

class YyyRepository implements YyyRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Ocs\Test\Handlers\DataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent test model.
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

		$this->data = $app['ocs.test.yyy.handler.data'];

		$this->setValidator($app['ocs.test.yyy.validator']);

		$this->setModel(get_class($app['Ocs\Test\Models\Yyy']));
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
		return $this->container['cache']->rememberForever('ocs.test.yyy.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.test.yyy.'.$id, function() use ($id)
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
		// Create a new yyy
		$yyy = $this->createModel();

		// Fire the 'ocs.test.yyy.creating' event
		if ($this->fireEvent('ocs.test.yyy.creating', [ $input ]) === false)
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
			// Save the yyy
			$yyy->fill($data)->save();

			// Fire the 'ocs.test.yyy.created' event
			$this->fireEvent('ocs.test.yyy.created', [ $yyy ]);
		}

		return [ $messages, $yyy ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the yyy object
		$yyy = $this->find($id);

		// Fire the 'ocs.test.yyy.updating' event
		if ($this->fireEvent('ocs.test.yyy.updating', [ $yyy, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($yyy, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the yyy
			$yyy->fill($data)->save();

			// Fire the 'ocs.test.yyy.updated' event
			$this->fireEvent('ocs.test.yyy.updated', [ $yyy ]);
		}

		return [ $messages, $yyy ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the yyy exists
		if ($yyy = $this->find($id))
		{
			// Fire the 'ocs.test.yyy.deleted' event
			$this->fireEvent('ocs.test.yyy.deleted', [ $yyy ]);

			// Delete the yyy entry
			$yyy->delete();

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
