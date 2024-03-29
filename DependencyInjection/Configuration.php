<?php

namespace Landmarx\Bundle\LandmarxBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
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
        $rootNode = $treeBuilder->root('landmarx_landmark');

        $rootNode
            ->children()
                ->arrayNode('providers')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('builder_alias')->defaultTrue()->end()
                        ->booleanNode('container_aware')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('twig')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('template')->defaultValue('landmarx_landmark.html.twig')->end()
                    ->end()
                ->end()
                ->booleanNode('templating')->defaultFalse()->end()
                ->scalarNode('default_renderer')->cannotBeEmpty()->defaultValue('twig')->end()
            ->end();

        return $treeBuilder;
    }
}
