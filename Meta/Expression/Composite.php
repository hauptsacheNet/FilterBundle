<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 13:13
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Hn\FilterBundle\Meta\FilterProperty;

abstract class Composite extends Expression
{
    /**
     * @var Expression[]|ArrayCollection
     * @fixme must be private
     */
    public $parts;

    /**
     * @param array $parts
     */
    function __construct(array $parts)
    {
        $this->parts = new ArrayCollection();
        foreach ($parts as $expression) {
            $this->parts->add($expression);
        }
    }

    /**
     * Creates an array of expression that can be joined by either expr->andX or expr->orX
     *
     * @param QueryBuilder $qb
     * @param mixed $value
     * @return object[]
     */
    protected function createArray(QueryBuilder $qb, $value)
    {
        $result = array();
        foreach ($this->parts as $part) {
            $result[] = $part->createExpression($qb, $value);
        }
        return $result;
    }

    /**
     * @param Expression $expression
     */
    public function addPart(Expression $expression)
    {
        $expression->setProperty($this->getProperty());
        $this->parts->add($expression);
    }

    /**
     * @return Expression[]|ArrayCollection
     */
    public function getParts()
    {
        return $this->parts;
    }

    /**
     * @param FilterProperty $property
     */
    public function setProperty(FilterProperty $property = null)
    {
        parent::setProperty($property);
        foreach ($this->parts as $expression) {
            $expression->setProperty($property);
        }
    }
}