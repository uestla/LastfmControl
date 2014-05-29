<?php

/**
 * This file is part of the LastfmControl package
 *
 * Copyright (c) 2013 Petr Kessler (http://kesspess.1991.cz)
 *
 * @license  MIT
 * @link     https://github.com/uestla/LastfmControl
 */

namespace Components\Factories;

use Nette;
use Components\Controls;


class LastfmControlFactory extends Nette\Object implements ILastfmControlFactory
{

	/** @var Nette\DI\IContainer */
	protected $container;


	/** @param  Nette\DI\IContainer */
	function __construct(Nette\DI\IContainer $container)
	{
		$this->container = $container;
	}


	/** @return Controls\LastfmControl */
	function createControl()
	{
		return $this->container->createLastfmControl();
	}

}
