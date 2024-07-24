<?php 
namespace OSW3\Search\DependencyInjection;

use Symfony\Component\Filesystem\Path;
use OSW3\Search\DependencyInjection\DefinitionConfigurator;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
	/**
	 * define the name of the configuration tree.
	 * > /config/packages/search.yaml
	 *
	 * @var string
	 */
	public const string NAME = "search";

	/**
	 * Define the translation domain
	 *
	 * @var string
	 */
	public const string DOMAIN = 'search';

	/**
	 * Update and return the Configuration Builder
	 *
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder(): TreeBuilder
    {
        $definition = require Path::join(__DIR__, "../../", "config/definition/definition.php");
        $builder    = new TreeBuilder( static::NAME );

        $definition(new DefinitionConfigurator($builder->getRootNode()));

		return $builder;
    }
}