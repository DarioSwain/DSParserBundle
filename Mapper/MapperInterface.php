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


interface MapperInterface
{
	/**
	 * @param object $entity
	 * @param array $conditions
	 * @return object
	 */
	public function map($entity, array $conditions);
} 