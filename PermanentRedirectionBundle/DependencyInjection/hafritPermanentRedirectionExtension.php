<?php
/**

 * Copyright (c) 12.2016.
 * Licence GPL/GNU
 * @Author: Hamdi Afrit <hamdi.afrit@gmail.com>
 */

namespace hafrit\PermanentRedirectionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class hafritPermanentRedirectionExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('hafrit_permanent_redirection.enable', $config['enable']);
        $container->setParameter('hafrit_permanent_redirection.redirection_lists', $config['redirection_lists']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
