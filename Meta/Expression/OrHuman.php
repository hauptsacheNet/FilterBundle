<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 15:50
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\Query\Expr\Orx;
use Doctrine\ORM\QueryBuilder;

class OrHuman extends Composite
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
        $values = preg_split('/\s+/', $value);

        $expressions = array();
        foreach ($values as $value) {
            if (empty($value)) continue;
            foreach ($this->createArray($qb, $value) as $expression) {
                $expressions[] = $expression;
            }
        }

        return new Orx($expressions);
    }
}