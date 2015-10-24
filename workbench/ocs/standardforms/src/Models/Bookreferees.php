<?php namespace Ocs\Standardforms\Models;

use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class Bookreferees extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'bookreferees';

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
	protected static $entityNamespace = 'ocs/standardforms.bookreferees';

}
