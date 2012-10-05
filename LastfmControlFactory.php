<?php

namespace Model\Factories;

use Components;


class LastfmControlFactory extends BaseControlFactory
{
	/** @return Components\LastfmControl */
	function create()
	{
		$c = new Components\LastfmControl;
		$this->onCreate( $c );
		return $c;
	}
}
