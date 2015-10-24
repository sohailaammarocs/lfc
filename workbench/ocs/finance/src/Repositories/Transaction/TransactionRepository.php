<?php namespace Ocs\Finance\Repositories\Transaction;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Finance\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface {

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

		$this->data = $app['ocs.finance.transaction.handler.data'];

		$this->setValidator($app['ocs.finance.transaction.validator']);

		$this->setModel(get_class($app['Ocs\Finance\Models\Transaction']));
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
		return $this->container['cache']->rememberForever('ocs.finance.transaction.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.finance.transaction.'.$id, function() use ($id)
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
		// Create a new transaction
		$transaction = $this->createModel();

		// Fire the 'ocs.finance.transaction.creating' event
		if ($this->fireEvent('ocs.finance.transaction.creating', [ $input ]) === false)
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
			// Save the transaction
			$transaction->fill($data)->save();

			// Fire the 'ocs.finance.transaction.created' event
			$this->fireEvent('ocs.finance.transaction.created', [ $transaction ]);
		}

		return [ $messages, $transaction ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the transaction object
		$transaction = $this->find($id);

		// Fire the 'ocs.finance.transaction.updating' event
		if ($this->fireEvent('ocs.finance.transaction.updating', [ $transaction, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($transaction, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the transaction
			$transaction->fill($data)->save();

			// Fire the 'ocs.finance.transaction.updated' event
			$this->fireEvent('ocs.finance.transaction.updated', [ $transaction ]);
		}

		return [ $messages, $transaction ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the transaction exists
		if ($transaction = $this->find($id))
		{
			// Fire the 'ocs.finance.transaction.deleted' event
			$this->fireEvent('ocs.finance.transaction.deleted', [ $transaction ]);

			// Delete the transaction entry
			$transaction->delete();

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
