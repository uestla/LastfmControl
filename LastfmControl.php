<?php

/**
 * This file is part of the LastfmControl package
 *
 * Copyright (c) 2013 Petr Kessler (http://kesspess.1991.cz)
 *
 * @license  MIT
 * @link     https://github.com/uestla/LastfmControl
 */

namespace Components\Controls;

use Nette\Utils\Strings;


/**
 * Component rendering last.fm users' music tastes
 *
 * @see http://www.last.fm/api
 */
class LastfmControl extends BaseControl
{

	const API_KEY = 'b25b959554ed76058ac220b7b2e0a026';


	/** @return void */
	function render()
	{
		call_user_func_array(callback($this, 'renderRecentTracks'), func_get_args());
	}


	/**
	 * Renders user's most recent listened tracks
	 *
	 * @param  string $user
	 * @param  int $limit
	 * @param  int $page
	 * @param  int $to
	 * @param  int $from
	 * @return void
	 * @see    http://www.last.fm/api/show?service=278
	 */
	function renderRecentTracks($user, $limit = 50, $page = 1, $to = NULL, $from = NULL)
	{
		$this->prepareTemplate(__DIR__ . '/recent-tracks.latte');

		$this->template->tracks = @simplexml_load_file('http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&' // intentionaly @
				. http_build_query(array(
					'user' => $user,
					'limit' => $limit,
					'page' => $page,
					'to' => $to,
					'from' => $from,
					'api_key' => static::API_KEY,
					'random_param' => Strings::random(), // trick against caching
				), '', '&')
		);

		$this->template->render();
	}


	/**
	 * Renders user's loved tracks
	 *
	 * @param  string $user
	 * @param  int $limit
	 * @param  int $page
	 * @return void
	 * @see    http://www.last.fm/api/show?service=329
	 */
	function renderLovedTracks($user, $limit = 50, $page = 1)
	{
		$this->prepareTemplate(__DIR__ . '/loved-tracks.latte');

		$this->template->tracks = @simplexml_load_file('http://ws.audioscrobbler.com/2.0/?method=user.getlovedtracks&' // intentionaly @
				. http_build_query(array(
					'user' => $user,
					'limit' => $limit,
					'page' => $page,
					'api_key' => static::API_KEY,
					'random_param' => Strings::random(), // trick against caching
				), '', '&')
		);

		$this->template->render();
	}


	// === HELPERS ===================================================

	/**
	 * @param  string|NULL $templateFile
	 * @return void
	 */
	protected function prepareTemplate($templateFile = NULL)
	{
		$this->template->registerHelper('absolutize', callback(__CLASS__ . '::absolutizeUrl'));

		if ($templateFile) {
			$this->template->setFile( $templateFile );
		}
	}


	/**
	 * @param  string $s
	 * @return string
	 */
	static function absolutizeUrl($s)
	{
		$p = 'http://';
		if (!Strings::startsWith($s, $p)) {
			$s = $p . $s;
		}

		return $s;
	}

}
