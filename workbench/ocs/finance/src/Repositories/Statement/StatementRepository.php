<?php namespace Ocs\Finance\Repositories\Statement;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Finance\Models\Statement;

class StatementRepository implements StatementRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Ocs\Finance\Handlers\DataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent finance model.
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

		$this->data = $app['ocs.finance.statement.handler.data'];

		$this->setValidator($app['ocs.finance.statement.validator']);

		$this->setModel(get_class($app['Ocs\Finance\Models\Statement']));
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
		return $this->container['cache']->rememberForever('ocs.finance.statement.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.finance.statement.'.$id, function() use ($id)
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
		// Create a new statement
		$statement = $this->createModel();

		// Fire the 'ocs.finance.statement.creating' event
		if ($this->fireEvent('ocs.finance.statement.creating', [ $input ]) === false)
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
			// Save the statement
			$statement->fill($data)->save();

			// Fire the 'ocs.finance.statement.created' event
			$this->fireEvent('ocs.finance.statement.created', [ $statement ]);
		}

		return [ $messages, $statement ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the statement object
		$statement = $this->find($id);

		// Fire the 'ocs.finance.statement.updating' event
		if ($this->fireEvent('ocs.finance.statement.updating', [ $statement, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($statement, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the statement
			$statement->fill($data)->save();

			// Fire the 'ocs.finance.statement.updated' event
			$this->fireEvent('ocs.finance.statement.updated', [ $statement ]);
		}

		return [ $messages, $statement ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the statement exists
		if ($statement = $this->find($id))
		{
			// Fire the 'ocs.finance.statement.deleted' event
			$this->fireEvent('ocs.finance.statement.deleted', [ $statement ]);

			// Delete the statement entry
			$statement->delete();

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
