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

namespace DS\ParserBundle\Validator;

use Symfony\Component\DomCrawler\Crawler;

class CrawlerValidator implements ValidatorInterface
{
	/**
	 * @param Crawler $value
	 * @param $constraint
	 * @return bool
	 * @throws \Exception
	 */
	public function validate($value, $constraint)
	{
		if(!($value instanceof Crawler))
		{
			throw new \Exception('Value will be a Crawler instance');
		}

		return (bool)$value->filter($constraint)->count();
	}
} 