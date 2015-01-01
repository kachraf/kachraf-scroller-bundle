<?php

namespace Kachraf\Bundle\ScrollBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KachrafScrollExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $scroller = $config['scrollers'][$container->getParameter("scroller")];
        $container->setParameter('kachraf_scroll_scroller.name', $scroller['name']);
        $container->setParameter('kachraf_scroll_scroller.page_range', $scroller['page_range']);
        $container->setParameter('kachraf_scroll_scroller.template',$scroller['template']);
        $container->setParameter('kachraf_scroll_scroller.template.main_page',$scroller['template']['main_page']);
        $container->setParameter('kachraf_scroll_scroller.template.page',$scroller['template']['page']);

    }

}
