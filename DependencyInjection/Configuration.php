<?php

namespace Kachraf\Bundle\ScrollBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('kachraf_scroll')
            ->children()
                ->arrayNode('scrollers')
                    ->prototype('array')
                        ->children()
                             ->scalarNode('name')->end()
                             ->integerNode('page_range')->defaultValue(5)->end()
                             ->arrayNode('template')
                                ->children()
                                    ->scalarNode('main_page')->defaultValue("KachrafScrollBundle:Article:index.html.twig")->end()
                                    ->scalarNode('page')->defaultValue("KachrafScrollBundle:Article:show.html.twig")->end()
                                ->end()
                             ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $builder;
    }



}
