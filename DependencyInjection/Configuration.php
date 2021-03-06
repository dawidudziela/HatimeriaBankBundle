<?php

namespace Hatimeria\BankBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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
        $rootNode = $treeBuilder->root('hatimeria_bank');

        $rootNode
            ->children()
                ->scalarNode('model_classes_path')->isRequired()->end()
                ->scalarNode('exchanger_ratio')->defaultValue('1000')->end()
                ->arrayNode("subscriptions")
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('free_until')->defaultValue(false)->end()
                        ->arrayNode('variants')
                            ->ignoreExtraKeys()
                            ->addDefaultsIfNotSet()
                            ->defaultValue(array())
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('virtual_packages')
                    ->defaultValue(array())
                    ->ignoreExtraKeys()
                    ->addDefaultsIfNotSet()
                ->end()
                ->arrayNode('sms_configuration')
                    ->addDefaultsIfNotSet()
                    ->defaultValue(array())
                    ->useAttributeAsKey('key')
                    ->prototype('scalar')
                    ->end()
                ->end()
                ->booleanNode('fake_dotpay_response')->defaultFalse()->end();

        return $treeBuilder;
    }
    
}
