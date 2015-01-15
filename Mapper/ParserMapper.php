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

namespace DS\ParserBundle\Mapper;

use DS\ParserBundle\Parser\AbstractParser;

class ParserMapper implements MapperInterface
{
	/** @var AbstractParser */
	protected $parser;

	public function __construct(AbstractParser $parser)
	{
		$this->parser = $parser;
	}

	/**
	 * {@inheritdoc}
	 */
	public function map($object, array $conditions)
	{
		foreach($conditions as $condition)
		{
			//TODO: Find condition on page and map to entity
		}

		return $object;
	}

} 