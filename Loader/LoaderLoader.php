<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10.10.14
 * Time: 10:02
 */

namespace Hn\FilterBundle\Loader;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class LoaderLoader implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $loaderServiceIds = $container->findTaggedServiceIds('hn_filter.loader');
        $factory = $container->getDefinition('hn_filter.factory');

        foreach ($loaderServiceIds as $loaderServiceId => $attributes) {
            $factory->addMethodCall('addLazyLoader', array(new Reference($loaderServiceId)));
        }
    }
}