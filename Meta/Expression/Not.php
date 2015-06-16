<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16.06.15
 * Time: 13:30
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\QueryBuilder;

class Not extends Expression
{
    /**
     * @var Expression
     */
    private $child;

    public function __construct(Expression $child)
    {
        $this->child = $child;
    }

    /**
     * Has to create the expression that can be thrown into $qb->where()
     *
     * @param QueryBuilder $qb
     * @param mixed $value
     * @return object
     */
    public function createExpression(QueryBuilder $qb, $value)
    {
        return $qb->expr()->not($this->child->createExpression($qb, $value));
    }
}