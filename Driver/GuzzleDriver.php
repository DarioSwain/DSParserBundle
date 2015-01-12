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

namespace DS\ParserBundle\Driver;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;

class GuzzleDriver implements DriverInterface
{
	/** @var ClientInterface */
	protected $client;

	public function __construct(ClientInterface $client)
	{
		$this->client = $client;
	}

	/**
	 * @param string $url
	 * @param string $method
	 * @return RequestInterface
	 */
	protected function getRequest($url, $method = 'GET')
	{
		return $this->client->createRequest($method, $url);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContent($url, $method = 'GET')
	{
		$request = $this->getRequest($url);
		return $this->client->send($request);
	}

} 