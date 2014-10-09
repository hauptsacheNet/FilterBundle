<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 12.08.14
 * Time: 12:05
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

class In extends MappedExpression
{
    /**
     * Has to create the expression that can be thrown into $qb->where()
     *
     * @param QueryBuilder $qb
     * @param mixed $value
     * @return object
     * @throws \RuntimeException
     */
    public function createExpression(QueryBuilder $qb, $value)
    {
        if ($value instanceof \Traversable) {
            $value = iterator_to_array($value);
        }

        if (!is_array($value) && $value !== null) {
            $type = is_object($value) ? get_class($value) : gettype($value);
            throw new \RuntimeException("In query requires an array, got $type");
        }


        if (empty($value)) {
            return '0=0';
        }

        return $qb->expr()->in($this->getMappedProperty(), $value);
    }
}