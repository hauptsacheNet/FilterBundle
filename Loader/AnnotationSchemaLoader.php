<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09.10.14
 * Time: 17:27
 */

namespace Hn\FilterBundle\Loader;


use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Reader;
use Hn\FilterBundle\Annotation\SimpleMetaAnnotation;
use Hn\FilterBundle\Exception\FilterMappingNotFoundException;
use Hn\FilterBundle\Meta\FilterClass;
use Hn\FilterBundle\Annotation\Filter;
use Hn\FilterBundle\Meta\FilterProperty;

/**
 * This loader checks if annotations are present to define if the class can be used as a filter.
 *
 * @package Hn\FilterBundle\Loader
 */
class AnnotationSchemaLoader implements LazySchemaLoaderInterface
{
    const A_FILTER = 'Hn\FilterBundle\Annotation\Filter';
    const A_FILTER_PROPERTY = 'Hn\FilterBundle\Annotation\Filter\Property';
    const A_EXPRESSION = 'Hn\FilterBundle\Annotation\Expression';

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @param Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param string $className
     * @return bool
     */
    public function hasClass($className)
    {
        $class = new \ReflectionClass($className);
        $filter = $this->annotationReader->getClassAnnotation($class, self::A_FILTER);
        return is_object($filter);
    }

    /**
     * @param string $className
     * @return FilterClass
     * @throws FilterMappingNotFoundException
     */
    public function loadClass($className)
    {
        $class = new \ReflectionClass($className);
        $filter = $this->annotationReader->getClassAnnotation($class, self::A_FILTER);

        if (!is_object($filter)) {
            throw new FilterMappingNotFoundException($className);
        }

        $filterProperties = array();
        foreach ($class->getProperties() as $property) {
            /** @var Filter\Property $filter */
            $filter = $this->annotationReader->getPropertyAnnotation($property, self::A_FILTER_PROPERTY);

            if ($filter === null) {
                continue;
            }

            $expression = $this->convertAnnotation($filter->expression);
            $type = constant('Hn\FilterBundle\Meta\FilterProperty::TYPE_' . $filter->type);
            $filterProperty = new FilterProperty($property->getName(), $expression, $type);
            $filterProperties[] = $filterProperty;
        }

        return new FilterClass($className, $filterProperties);
    }

    /**
     * @param array $arguments
     * @return array
     */
    protected function convertAnnotations(array $arguments)
    {
        foreach ($arguments as &$argument) {

            if ($argument instanceof SimpleMetaAnnotation) {
                $argument = $this->convertAnnotation($argument);
            }

            if (is_array($argument)) {
                $argument = $this->convertAnnotations($argument);
            }
        }

        return $arguments;
    }

    /**
     * @param SimpleMetaAnnotation $annotation
     * @return object
     */
    protected function convertAnnotation(SimpleMetaAnnotation $annotation)
    {
        $arguments = $this->convertAnnotations($annotation->getConstructorArguments());
        $metaClass = str_replace('\\Annotation\\', '\\Meta\\', get_class($annotation));
        $metaClass = new \ReflectionClass($metaClass);

        return $metaClass->newInstanceArgs($arguments);
    }
}