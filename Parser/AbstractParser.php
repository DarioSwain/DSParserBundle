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
	 * 	array('product' => 'h1 > p > body')
	 *
	 * @var array
	 */
	protected $conditions;

	protected $lastConditionSourceType;

	public function __construct(ClientInterface $client, array $conditions = array())
	{
		$this->client = $client;
		$this->validators = $conditions;
		$this->lastConditionSourceType = null;
	}

	/**
	 * @param $uri
	 * @return Crawler
	 */
	public function goToPage($uri)
	{
		return $this->client->request('GET',$uri);
	}

	public function parseLinks($uri)
	{
		$page = $this->goToPage($uri);

		if($this->isValid($page))
		{
			//TODO: What return entity or array??
			$page->filter('a')
				->extract(array('_text', 'href'));
		}
	}

	public function isValid(Crawler $page)
	{
		if(empty($this->validators))
			return true;

		foreach($this->conditions as $type => $condition)
		{
			if($page->filter($condition)->count())
			{
				$this->lastConditionSourceType = $type;
				return true;
			}
		}

		return false;
	}


}