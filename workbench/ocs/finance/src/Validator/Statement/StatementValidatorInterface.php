<?php namespace Ocs\Finance\Validator\Statement;

interface StatementValidatorInterface {

	/**
	 * Updating a statement scenario.
	 *
	 * @return void
	 */
	public function onUpdate();

}
