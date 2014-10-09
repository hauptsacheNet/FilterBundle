<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 13:28
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

class OrX extends Composite
{
    /**
     * Has to create the expression that can be thrown into $qb->where()
     *
     * @param QueryBuilder $qb
     * @param mixed $value
     * @return object
     */
    public function createExpression(QueryBuilder $qb, $value)
    {
        return new Expr\Orx($this->createArray($qb, $value));
    }
}