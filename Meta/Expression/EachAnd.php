<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16.06.15
 * Time: 15:23
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\QueryBuilder;

class EachAnd extends Expression
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
        $andX = $qb->expr()->andX();
        foreach ($value as $entry) {
            $andX->add($this->child->createExpression($qb, $entry));
        }
        return $andX;
    }
}