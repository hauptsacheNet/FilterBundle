<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 04.06.14
 * Time: 13:05
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

class Contains extends MappedExpression
{
    function __construct($mappedProperty)
    {
        parent::__construct($mappedProperty);
    }

    public function createExpression(QueryBuilder $qb, $value)
    {
        $value = str_replace(
            array('=', '_', '%'),
            array('==', '=_', '=%'),
            $value
        );

        $parameterIndex = $qb->getParameters()->count();
        $expr = new Expr\Comparison($this->getMappedProperty(), 'LIKE', "?$parameterIndex ESCAPE '='");
        $qb->setParameter($parameterIndex, "%$value%"); // FIXME should not be set here
        return $expr;
    }
}