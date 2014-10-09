<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 12:25
 */

namespace Hn\FilterBundle\Factory;


use Hn\FilterBundle\Exception\FilterMappingNotFoundException;
use Hn\FilterBundle\Meta\FilterClass;
use Hn\FilterBundle\Meta\FilterDefinitionInterface;

class FilterMetaFactory implements FilterMetaFactoryInterface, FilterMetaCollectionInterface
{
    private $mapping = array();

    /**
     * @param string $className
     * @return FilterClass
     * @throws \Hn\FilterBundle\Exception\FilterMappingNotFoundException
     */
    public function getMetadataFor($className)
    {
        if (array_key_exists($className, $this->mapping)) {
            return $this->mapping[$className];
        } else {
            throw new FilterMappingNotFoundException($className);
        }
    }

    public function addMetaClass(FilterClass $filterClass)
    {
        $this->mapping[$filterClass->getName()] = $filterClass;
    }

    public function addMetaConfigurator(FilterDefinitionInterface $filterDefinition)
    {
        $filterDefinition->define($this);
    }
} 