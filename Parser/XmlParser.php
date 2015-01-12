<?php
/**
 * This file is part of the DSParser bundle.
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

use Symfony\Component\DomCrawler\Crawler;

class XmlParser extends AbstractParser
{
	/**
	 * {@inheritdoc}
	 */
	protected function parse($url, $method = 'GET')
	{
		$response = $this->driver->getContent($url, $method);

		return new Crawler($response->xml()->asXML());
	}
} 