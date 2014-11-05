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

namespace DS\ParserBundle\Scanner;


use DS\ParserBundle\Model\Source;
use DS\ParserBundle\Parser\ParserInterface;

abstract class AbstractScanner
{
	/**
	 * @var ParserInterface
	 */
	protected $parser;

	protected $source;

	protected $amountOfPagesToParse = 5;

	public function __construct(ParserInterface $parser, Source $source)
	{
		$this->parser = $parser;
		$this->source = $source;
	}

	public function getSource()
	{
		return $this->source;
	}

	public function processLink()
	{
		$this->persistLinks($this->parser->parseLinks($this->getLink()));
	}

	abstract public function processContent();

	public function getLink()
	{
		//TODO: Get link from storage for parsing
		//Storage->getNotParsedLink();
		if(true)
		{
			foreach($this->source->getUris() as $uri)
			{
				//TODO: Check if start link is not parsed now
				if(true)
				{
					return $uri;
				}
			}
		}
		return "";
	}


	public function persistLinks(array $links)
	{
		if(empty($links))
			return;

		foreach($links as $link)
		{
			if(is_array($link) && count($link)>=2)
			{
				//TODO: Save link to storage
				//Storage->save()
			}
		}
	}
}