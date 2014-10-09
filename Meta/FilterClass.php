<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 12:48
 */

namespace Hn\FilterBundle\Meta;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;

class FilterClass
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var FilterProperty[]|ArrayCollection
     */
    private $filterProperties;

    /**
     * @param string $name
     * @param array $filterProperties
     */
    public function __construct($name, array $filterProperties = array())
    {
        $this->name = $name;
        $this->filterProperties = new ArrayCollection();
        foreach ($filterProperties as $filterProperty) {
            $this->addFilterProperty($filterProperty);
        }
    }

    public function addFilterProperty(FilterProperty $filterProperty)
    {
        if ($filterProperty !== null) {
            if ($filterProperty->getClass() !== null) {
                throw new \LogicException("an instance of a property can only be used once");
            }
            $filterProperty->setClass($this);
        }
        $this->filterProperties->add($filterProperty);
    }

    public function removeFilterProperty(FilterProperty $filterProperty)
    {
        $this->filterProperties->removeElement($filterProperty);
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return FilterProperty[]|ArrayCollection
     */
    public function getFilterProperties()
    {
        return $this->filterProperties;
    }

    /**
     * @return \ReflectionClass
     */
    public function getReflectionClass()
    {
        return new \ReflectionClass($this->name);
    }
}