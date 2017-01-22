<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use AppBundle\Builder\DefaultFeedBuilder;

/**
 * Class Configuration
 * @package AppBundle\DependencyInjection
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('feeds');

        $rootNode
            ->children()
                ->arrayNode('items')
                ->useAttributeAsKey('code')
                ->prototype('array')
                    ->children()
                        ->scalarNode('base_uri')->cannotBeEmpty()->end()
                        ->scalarNode('suffix')->cannotBeEmpty()->end()
                        ->scalarNode('builder')->defaultValue(DefaultFeedBuilder::class)->cannotBeEmpty()->end()
        ;

        return $treeBuilder;
    }
}
