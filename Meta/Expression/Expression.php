<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 12:44
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\QueryBuilder;
use Hn\FilterBundle\Meta\FilterProperty;

abstract class Expression
{
    /**
     * @var FilterProperty
     */
    private $property;

    /**
     * Has to create the expression that can be thrown into $qb->where()
     *
     * @param QueryBuilder $qb
     * @param mixed $value
     * @return object
     */
    public abstract function createExpression(QueryBuilder $qb, $value);

    /**
     * @param \Hn\FilterBundle\Meta\FilterProperty $property
     */
    public function setProperty(FilterProperty $property = null)
    {
        $this->property = $property;
    }

    /**
     * @return \Hn\FilterBundle\Meta\FilterProperty
     */
    public function getProperty()
    {
        return $this->property;
    }

}