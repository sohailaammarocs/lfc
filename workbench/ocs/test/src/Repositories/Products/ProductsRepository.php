<?php namespace Ocs\Test\Repositories\Products;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Test\Models\Products;

class ProductsRepository implements ProductsRepositoryInterface {

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

		$this->data = $app['ocs.test.products.handler.data'];

		$this->setValidator($app['ocs.test.products.validator']);

		$this->setModel(get_class($app['Ocs\Test\Models\Products']));
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
		return $this->container['cache']->rememberForever('ocs.test.products.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.test.products.'.$id, function() use ($id)
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
		// Create a new products
		$products = $this->createModel();

		// Fire the 'ocs.test.products.creating' event
		if ($this->fireEvent('ocs.test.products.creating', [ $input ]) === false)
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
			// Save the products
			$products->fill($data)->save();

			// Fire the 'ocs.test.products.created' event
			$this->fireEvent('ocs.test.products.created', [ $products ]);
		}

		return [ $messages, $products ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the products object
		$products = $this->find($id);

		// Fire the 'ocs.test.products.updating' event
		if ($this->fireEvent('ocs.test.products.updating', [ $products, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($products, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the products
			$products->fill($data)->save();

			// Fire the 'ocs.test.products.updated' event
			$this->fireEvent('ocs.test.products.updated', [ $products ]);
		}

		return [ $messages, $products ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the products exists
		if ($products = $this->find($id))
		{
			// Fire the 'ocs.test.products.deleted' event
			$this->fireEvent('ocs.test.products.deleted', [ $products ]);

			// Delete the products entry
			$products->delete();

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
