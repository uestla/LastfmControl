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

use Components\Controls;


interface ILastfmControlFactory
{

	/** @return Controls\LastfmControl */
	function createControl();

}
