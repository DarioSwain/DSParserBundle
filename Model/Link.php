<?php
/**
 * This file is part of the Wall Poster bundle.
 *
 * (c) Ilya Pokamestov 
 * 
 * @author Ilya Pokamestov
 * @email dario_swain@yahoo.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DS\ParserBundle\Model;


class Link
{
	/**
	 * @var string
	 */
	protected $uri;

	/**
	 * @var string
	 */
	protected $title;

	public function getUri()
	{
		return $this->uri;
	}

	public function setUri($uri)
	{
		$this->uri = $uri;

		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}
}