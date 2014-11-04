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


class DefaultParser extends AbstractParser
{

	/**
	 * {@inheritdoc}
	 */
	public function parseLinks($uri)
	{
		return $this->goToPage($uri)
			->filter('a')
			->extract(array('_text', 'href'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function parseContent($uri, $condition)
	{
		return array();
	}

} 