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

namespace DS\ParserBundle\Browser;

use Symfony\Component\DomCrawler\Crawler;

interface ClientInterface
{
	/**
	 * @param string $method
	 * @param string $uri
	 * @return Crawler
	 */
	public function request($method, $uri);
}