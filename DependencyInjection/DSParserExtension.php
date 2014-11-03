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

namespace DS\ParserBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class DSParserExtension extends Extension
{
	protected $configDirectory = '/../Resources/config';
	protected $configFiles = array(
		'services',
	);

	public function load(array $configs, ContainerBuilder $container)
	{
		$processor = new Processor();
		$configuration = new Configuration();
		$config = $processor->processConfiguration($configuration, $configs);
		$loader = new XmlFileLoader($container, new FileLocator($this->getConfigurationDirectory()));
		$loader->load(sprintf('%s.xml', $config['driver']));
		$container->setParameter($this->getAlias() . '.backend_type_' . $config['driver'], true);
	}

	/**
	 * @param array         $config
	 * @param XmlFileLoader $loader
	 */
	protected function loadConfigurationFile(array $config, XmlFileLoader $loader)
	{
		foreach ($config as $filename) {
			if (file_exists($file = sprintf('%s/%s.xml', $this->getConfigurationDirectory(), $filename))) {
				$loader->load($file);
			}
		}
	}

	/**
	 * Get the configuration directory
	 *
	 * @return string
	 * @throws \RuntimeException
	 */
	protected function getConfigurationDirectory()
	{
		$reflector = new \ReflectionClass($this);
		$fileName = $reflector->getFileName();

		if (!is_dir($directory = dirname($fileName) . $this->configDirectory)) {
			throw new \RuntimeException(sprintf('The configuration directory "%s" does not exists.', $directory));
		}

		return $directory;
	}
}