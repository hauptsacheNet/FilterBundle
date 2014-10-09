<?php
/**
 * Created by PhpStorm.
 * User: marcopfeiffer
 * Date: 03.06.14
 * Time: 12:44
 */

namespace Hn\FilterBundle\Meta\Expression;


use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

class Comparator extends MappedExpression
{
    const EQ  = '=';
    const NEQ = '<>';
    const LT  = '<';
    const LTE = '<=';
    const GT  = '>';
    const GTE = '>=';
    const LIKE = 'LIKE';
    const NLIKE = 'NOT LIKE';

    private $operator;

    function __construct($mappedProperty, $operator = Expr\Comparison::EQ)
    {
        parent::__construct($mappedProperty);
        $this->operator = $operator;
    }

    public function createExpression(QueryBuilder $qb, $value)
    {
        $parameterIndex = $qb->getParameters()->count();
        $expr = new Expr\Comparison($this->getMappedProperty(), $this->getOperator(), "?$parameterIndex");
        $qb->setParameter($parameterIndex, $value); // FIXME should not be set here
        return $expr;
    }

    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

}