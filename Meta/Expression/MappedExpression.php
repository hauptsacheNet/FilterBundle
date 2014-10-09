<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 13:21
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\Common\Collections\ArrayCollection;

abstract class MappedExpression extends Expression
{
    /**
     * The name of the property in the query
     *
     * eg. 'person.name' in:
     * $qb->expr->eq('person.name', 'Max')
     *
     * @var string
     */
    private $mappedProperty;

    public function __construct($mappedProperty)
    {
        $this->mappedProperty = $mappedProperty;
    }

    /**
     * @param string $mappedProperty
     */
    public function setMappedProperty($mappedProperty)
    {
        $this->mappedProperty = $mappedProperty;
    }

    /**
     * @return string
     */
    public function getMappedProperty()
    {
        return $this->mappedProperty;
    }

    /**
     * @return ArrayCollection
     */
    public function getTokenizer()
    {
        return $this->tokenizer;
    }
}