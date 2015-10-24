<?php namespace Ocs\Standardforms\Repositories\Contactusform;

use Validator;
use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Ocs\Standardforms\Models\Contactusform;

class ContactusformRepository implements ContactusformRepositoryInterface {

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

		$this->data = $app['ocs.standardforms.contactusform.handler.data'];

		$this->setValidator($app['ocs.standardforms.contactusform.validator']);

		$this->setModel(get_class($app['Ocs\Standardforms\Models\Contactusform']));
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
		return $this->container['cache']->rememberForever('ocs.standardforms.contactusform.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('ocs.standardforms.contactusform.'.$id, function() use ($id)
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
		// Create a new contactusform
		$contactusform = $this->createModel();

		// Fire the 'ocs.standardforms.contactusform.creating' event
		if ($this->fireEvent('ocs.standardforms.contactusform.creating', [ $input ]) === false)
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
			// Save the contactusform
			$contactusform->fill($data)->save();

			// Fire the 'ocs.standardforms.contactusform.created' event
			$this->fireEvent('ocs.standardforms.contactusform.created', [ $contactusform ]);
		}

		return [ $messages, $contactusform ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the contactusform object
		$contactusform = $this->find($id);

		// Fire the 'ocs.standardforms.contactusform.updating' event
		if ($this->fireEvent('ocs.standardforms.contactusform.updating', [ $contactusform, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($contactusform, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the contactusform
			$contactusform->fill($data)->save();

			// Fire the 'ocs.standardforms.contactusform.updated' event
			$this->fireEvent('ocs.standardforms.contactusform.updated', [ $contactusform ]);
		}

		return [ $messages, $contactusform ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the contactusform exists
		if ($contactusform = $this->find($id))
		{
			// Fire the 'ocs.standardforms.contactusform.deleted' event
			$this->fireEvent('ocs.standardforms.contactusform.deleted', [ $contactusform ]);

			// Delete the contactusform entry
			$contactusform->delete();

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
