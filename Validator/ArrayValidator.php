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

class ArrayValidator implements ValidatorInterface
{
	/**
	 * @param array $value
	 * @param $constraint
	 * @return bool
	 * @throws \Exception
	 */
	public function validate($value, $constraint)
	{
		if(!is_array($value))
		{
			throw new \Exception('Value will be a array');
		}

		$searchResult = $this->search($value, explode(' ', trim($constraint)), 0);

		return !empty($searchResult);
	}

	protected function search($array, $keys, $keyIndex)
	{
		$results = array();

		if (is_array($array)) {
			if (isset($array[$keys[$keyIndex]]) && is_array($array[$keys[$keyIndex]]) && count($keys)-1 == $keyIndex) {
				$results[$keys[$keyIndex]] = $array[$keys[$keyIndex]];
			}
			elseif (isset($array[$keys[$keyIndex]]) && !is_array($array[$keys[$keyIndex]])) {
				$results[$keys[$keyIndex]] = $array[$keys[$keyIndex]];
			}
			elseif(isset($array[$keys[$keyIndex]]) && count($keys)-1 != $keyIndex && is_array($array[$keys[$keyIndex]]))
			{
				$validElements = array();
				$keyForSearch[] = $keys[$keyIndex+1];
				foreach($array[$keys[$keyIndex]] as $newKey => $newValue)
				{
					if(is_array($newValue))
					{
						$validElement = $this->search($newValue, $keyForSearch, 0);
						if(!empty($validElement))
						{
							$validElements[$newKey] = $validElement;
						}
					}
				}

				if(!empty($validElements))
				{
					$results[$keys[$keyIndex]] = $validElements;
				}
			}
		}

		return $results;
	}
}