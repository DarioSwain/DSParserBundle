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


use DS\ParserBundle\DSParserBundle;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
	/**
	 * Generates the configuration tree.
	 *
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root(DSParserBundle::getBundlePrefix());
		$supportedDrivers = DSParserBundle::getSupportedDrivers();
		$rootNode
			->children()
				->scalarNode('driver')
					->validate()
						->ifNotInArray($supportedDrivers)
						->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
					->end()
					->cannotBeOverwritten()
					->isRequired()
					->cannotBeEmpty()
				->end()
				->scalarNode('user_class')->isRequired()->cannotBeEmpty()->end()
				->scalarNode('firewall_name')->isRequired()->cannotBeEmpty()->end()
				->scalarNode('model_manager_name')->defaultNull()->end()
				->booleanNode('use_listener')->defaultTrue()->end()
				->booleanNode('use_flash_notifications')->defaultTrue()->end()
				->booleanNode('use_username_form_type')->defaultTrue()->end()
				->arrayNode('from_email')
					->addDefaultsIfNotSet()
					->children()
						->scalarNode('address')->defaultValue('webmaster@example.com')->cannotBeEmpty()->end()
						->scalarNode('sender_name')->defaultValue('webmaster')->cannotBeEmpty()->end()
					->end()
				->end()
			->end();
		$this->addProfileSection($rootNode);
		return $treeBuilder;
	}

	private function addProfileSection(ArrayNodeDefinition $node)
	{
		$node
			->children()
				->arrayNode('profile')
					->addDefaultsIfNotSet()
					->canBeUnset()
					->children()
						->arrayNode('form')
							->addDefaultsIfNotSet()
							->children()
								->scalarNode('type')->defaultValue('fos_user_profile')->end()
								->scalarNode('name')->defaultValue('fos_user_profile_form')->end()
								->arrayNode('validation_groups')
									->prototype('scalar')->end()
									->defaultValue(array('Profile', 'Default'))
								->end()
							->end()
						->end()
					->end()
				->end()
			->end();
	}
} 