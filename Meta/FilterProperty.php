<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 12:40
 */

namespace Hn\FilterBundle\Meta;


use Hn\FilterBundle\Meta\Expression\Expression;

class FilterProperty
{
    /**
     * Simple compare operation of scalar values
     */
    const TYPE_SCALAR = 1;
    /**
     * The containing value is another mapped filter object
     */
    const TYPE_OBJECT = 2;
    /**
     * The containing value is an object from which the id should be used
     */
    const TYPE_ID = 4;
    /**
     * The value is a collection on which all values have to match
     */
    const TYPE_COLLECTION = 8;

    /**
     * one of the TYPE_* constants
     *
     * @var number
     */
    private $type;

    /**
     * The name of this property or key
     *
     * @var string
     */
    private $name;

    /**
     * @var Expression
     */
    private $expression;

    /**
     * @var FilterClass
     */
    private $class;

    function __construct($name, Expression $expression = null, $type = FilterProperty::TYPE_SCALAR)
    {
        $this->setName($name);
        $this->setExpression($expression);
        $this->setType($type);
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
     * @param \Hn\FilterBundle\Meta\Expression\Expression $expression
     * @throws \LogicException
     */
    public function setExpression(Expression $expression = null)
    {
        if ($expression !== null) {
            if ($expression->getProperty() !== null) {
                throw new \LogicException("an instance of an expression can only be used once");
            }
            $expression->setProperty($this);
        }
        if ($this->expression !== null) {
            $this->expression->getProperty()->expression = null;
            $this->expression->setProperty(null);
        }
        $this->expression = $expression;
    }

    /**
     * @return \Hn\FilterBundle\Meta\Expression\Expression
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param number $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \Hn\FilterBundle\Meta\FilterClass $class
     */
    public function setClass(FilterClass $class = null)
    {
        $this->class = $class;
    }

    /**
     * @return \Hn\FilterBundle\Meta\FilterClass
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return \ReflectionProperty
     */
    public function getReflectionProperty()
    {
        return $this->getClass()->getReflectionClass()->getProperty($this->getName());
    }
}