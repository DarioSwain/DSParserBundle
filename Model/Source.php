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

use DS\ParserBundle\Parser\ParserInterface;

class Source
{
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var ParserInterface
	 */
	protected $parser;

	/**
	 * @var array
	 */
	protected $uris;

	protected $validator;

	public function __construct()
	{
		$this->uris = array();
	}

	public function getUris()
	{
		return $this->uris;
	}

	public function setUris(array $uris)
	{
		$this->uris = $uris;

		return $this;
	}

	public function addUri($uri)
	{
		array_push($this->uris, $uri);

		return $this;
	}
}