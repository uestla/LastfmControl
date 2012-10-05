<?php

namespace Model\Factories;

use Components;


class LastfmControlFactory extends BaseControlFactory
{
	/**
	 * @param  string
	 * @return Components\LastfmControl
	 */
	function create($appID)
	{
		$c = new Components\LastfmControl;
		$this->onCreate( $c );
		return $c;
	}
}
