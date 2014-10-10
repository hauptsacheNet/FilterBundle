<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09.10.14
 * Time: 17:45
 */

namespace Hn\FilterBundle\Loader;


use Hn\FilterBundle\Exception\FilterMappingNotFoundException;
use Hn\FilterBundle\Meta\FilterClass;

interface LazySchemaLoaderInterface
{
    /**
     * @param string $className
     * @return bool
     */
    public function hasClass($className);

    /**
     * @param string $className
     * @return FilterClass
     * @throws FilterMappingNotFoundException
     */
    public function loadClass($className);
}