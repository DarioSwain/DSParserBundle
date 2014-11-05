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

use DS\ParserBundle\Browser\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractParser implements ParserInterface
{
	/**
	 * @var ClientInterface
	 */
	protected $client;
	/**
	 * @var Crawler
	 */
	protected $page;

	public function __construct(ClientInterface $client)
	{
		$this->client = $client;
	}

	/**
	 * @param $uri
	 * @return Crawler
	 */
	public function goToPage($uri)
	{
		$this->page = $this->client->request('GET',$uri);

		return $this->page;
	}

}