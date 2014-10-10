<?php

namespace Hn\FilterBundle;

use Hn\FilterBundle\Loader\LoaderLoader;
use Hn\FilterBundle\Loader\PHPLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HnFilterBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new PHPLoader());
        $container->addCompilerPass(new LoaderLoader());
    }

}
