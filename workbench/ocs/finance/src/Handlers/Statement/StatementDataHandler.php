<?php namespace Ocs\Finance\Handlers\Statement;

class StatementDataHandler implements StatementDataHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function prepare(array $data)
	{
		return $data;
	}

}
