<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 12:25
 */

namespace Hn\FilterBundle\Factory;


use Hn\FilterBundle\Exception\FilterMappingNotFoundException;
use Hn\FilterBundle\Loader\LazySchemaLoaderInterface;
use Hn\FilterBundle\Meta\FilterClass;
use Hn\FilterBundle\Meta\FilterDefinitionInterface;

class FilterMetaFactory implements FilterMetaFactoryInterface, FilterMetaCollectionInterface
{
    private $mapping = array();

    /**
     * @var LazySchemaLoaderInterface[]
     */
    private $loaders = array();

    /**
     * @param string $className
     * @return FilterClass
     * @throws \Hn\FilterBundle\Exception\FilterMappingNotFoundException
     */
    public function getMetadataFor($className)
    {
        if (array_key_exists($className, $this->mapping)) {
            return $this->mapping[$className];
        }

        foreach ($this->loaders as $loader) {

            if ($loader->hasClass($className)) {
                return $this->mapping[$className] = $loader->loadClass($className);
            }
        }

        throw new FilterMappingNotFoundException($className);
    }

    public function addMetaClass(FilterClass $filterClass)
    {
        $this->mapping[$filterClass->getName()] = $filterClass;
    }

    public function addMetaConfigurator(FilterDefinitionInterface $filterDefinition)
    {
        $filterDefinition->define($this);
    }

    /**
     * @param LazySchemaLoaderInterface $lazySchemaLoader
     */
    public function addLazyLoader(LazySchemaLoaderInterface $lazySchemaLoader)
    {
        $this->loaders[spl_object_hash($lazySchemaLoader)] = $lazySchemaLoader;
    }
} 