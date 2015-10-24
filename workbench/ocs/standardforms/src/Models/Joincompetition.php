<?php namespace Ocs\Standardforms\Models;

use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class Joincompetition extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'joincompetitions';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $with = [
		'values.attribute',
	];

	/**
	 * {@inheritDoc}
	 */
	protected static $entityNamespace = 'ocs/standardforms.joincompetition';

}
