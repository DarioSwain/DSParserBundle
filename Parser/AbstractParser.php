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

use DS\ParserBundle\Driver\DriverInterface;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractParser
{
	/**
	 * @var DriverInterface
	 */
	protected $driver;

	/**
	 * 	array('product' => 'h1 > p > body')
	 *
	 * @var array
	 */
	protected $conditions;

	protected $pages = array();

	public function __construct(DriverInterface $driver, array $conditions = array())
	{
		$this->driver = $driver;
		$this->conditions = $conditions;
		$this->lastConditionSourceType = null;
	}

	/**
	 * @param string $url
	 * @param string $method
	 * @return Crawler|array
	 */
	abstract protected function parse($url, $method = 'GET');

	/**
	 * Setup additional parameters
	 *
	 * @param Crawler $page
	 * @return Crawler
	 */
	protected function preparePage($page)
	{
		return $page;
	}

	/**
	 * @param string $url
	 * @param string $condition
	 * @param array $extract
	 * @param string $method
	 * @return array|null
	 * @throws \Exception
	 */
	public function find($url, $condition, $extract = array('_text'), $method = 'GET')
	{
		$page = $this->getPage($url, $method);

		if($page instanceof Crawler)
		{
			$page = $this->preparePage($page);

			$filteredValue = $page->filter($condition);

			return $filteredValue->extract($extract);
		}
		elseif(is_array($page))
		{
			$arrayKeys = explode('>', $condition);
			$arrayKeys = array_map('trim',$arrayKeys);

			$element = null;
			foreach($arrayKeys as $key)
			{
				if(isset($page[$key]))
				{
					$element = $page[$key];
					continue;
				}

				throw new \Exception('Node not found');
			}

			if(is_array($element))
			{
				throw new \Exception('Node with deeper nodes founded');
			}

			return $element;
		}
		else
		{
			throw new \Exception('Unknown page type');
		}
	}

	/**
	 * @param string $url
	 * @param string $method
	 * @return Crawler|array
	 */
	public function getPage($url, $method = 'GET')
	{
		if(!isset($this->pages[$url]))
		{
			$page = $this->parse($url, $method);
			$this->pages[$url] = $page;
		}

		return $this->pages[$url];
	}

}