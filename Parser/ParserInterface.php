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

namespace DS\ParserBundle\Parser;

interface ParserInterface
{
	/**
	 * @param $uri
	 * @return array
	 */
	public function parseLinks($uri);

	/**
	 * @param $uri
	 * @param array $conditions
	 * @return array
	 */
	public function parseContent($uri, $conditions);
} 