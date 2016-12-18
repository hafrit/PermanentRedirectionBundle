<?php
/**
 * Copyright (c) 12.2016.
 * Licence GPL/GNU
 * @Author: Hamdi Afrit <hamdi.afrit@gmail.com>
 */

namespace hafrit\PermanentRedirectionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('hafrit_permanent_redirection')
            ->children()
                ->booleanNode('enable')->end()
                ->arrayNode('redirection_lists')
                    ->beforeNormalization()->ifString()->then(function ($v) { return array($v); })->end()
                    ->prototype('array')
                    ->children()
                        ->scalarNode('source')->isRequired(true)->end()
                        ->scalarNode('target')->isRequired(true)->end()
                        ->scalarNode('status')->isRequired(true)->end()
                        ->integerNode('referenceType')->defaultValue('1')->end()
                        ->booleanNode('keepParameters')->defaultValue(false)->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
