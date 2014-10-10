<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 11:24
 */

namespace Hn\FilterBundle\Loader;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This loader has to be attached to the compiler and loads the configuration by changing the definition.
 * It is therefor the most flexable but probably slowest loader as it has to load ALL configuration.
 *
 * @package Hn\FilterBundle\Loader
 */
class PHPLoader implements CompilerPassInterface
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
        if (!$container->hasDefinition('hn_filter.factory')) {
            return;
        }
        $definition = $container->getDefinition('hn_filter.factory');

        // add all classes tagged as configuration to our service
        $taggedServices = $container->findTaggedServiceIds('hn_filter.definition');
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addMetaConfigurator',
                array(new Reference($id))
            );
        }
    }
}