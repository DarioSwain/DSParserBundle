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

namespace DS\ParserBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Bridge\Doctrine\DependencyInjection\CompilerPass\RegisterMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DSParserBundle extends Bundle
{
	const ORM_DRIVER = 'orm';

	public static function getSupportedDrivers()
	{
		return array(
			self::ORM_DRIVER
		);
	}

	public static function getBundlePrefix()
	{
		return 'ds_parser';
	}


	/**
	 * {@inheritdoc}
	 */
	public function build(ContainerBuilder $container)
	{
		$mappings = array(
			realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DS\ParserBundle\Model',
		);
		if (class_exists('Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass')) {
			$container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array(sprintf('%s.model_manager_name',self::getBundlePrefix())), sprintf('%s.backend_type_orm',self::getBundlePrefix())));
		} else {
			$container->addCompilerPass(RegisterMappingsPass::createOrmMappingDriver($mappings));
		}
	}
}